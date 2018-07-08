<?php

namespace Api;

/**
 * Receives the request and processes it.
 *
 * The requested URL is taken and stored in an array of data
 * For example, if the URL requested is http://localhost/api/user
 * $ _SERVER ['REQUEST_URI'] prints "/api/user"
 * The explode () function creates an array of the URL in the following way
 *
 *      Array
 *      (
 *          [0] =>
 *          [1] => api
 *          [2] => user
 *      )
 *
 * If the URL requested is http://localhost/api/user/1
 * $ _SERVER ['REQUEST_URI'] prints "/api/user/1"
 * The explode () function creates an array of the URL in the following way.
 * Note in this case the difference in the identifier of the user entity.
 *
 *      Array
 *      (
 *          [0] =>
 *          [1] => api
 *          [2] => user
 *          [3] => 1
 *      )
 *
 * @author riv4wi
 * @version 1.0
 */

class ApiRestController{

    private $array;
    private $bodyRequest;
    private $id;
    private $api;

    public function __construct()
    {
        /* By decomposing the URI it can determine if the general URL or a specific element is being requested*/
        $this->array = explode("/", $_SERVER['REQUEST_URI']);

        /* Get the body of the HTTP request. In our case, the body will only be sent in POST and PUT requests,
         in which we will send the JSON object to register or modify */
        $this->bodyRequest = file_get_contents("php://input");

        /* The next cycle goes through the previously created array and if there is any blank value, it eliminates
        it from the array. This in order to control when the URL is sent in style http://localhost/api/user/
        Although, it is using the "/" at the end, no id parameter is being sent, however, the array is created
        in the following way

        Array
        (
           [0] =>
           [1] => api
           [2] => user
           [3] =>
        )

        Since the last position is empty, if we allow it that way, it will throw us an error because it does not make
        the request correctly with a data that is empty, so if the URL is sent by this way, it is assumed that it is
        being done a general request like http://localhost/api/user */
        foreach ($this->array as $key => $value) {
            if (empty($value)) {
                unset($this->array[$key]);
            }
        }

        /* Analyze the last position of the previously created array, if the value analyzed is greater than 0 it means
        that the sent character is a number (an identifier), therefore, we recognize that the request is being made to a
        specific id of type http://localhost/api/user/1, but if not greater than 0, we recognize that the last element of
        the array is just the name of the entity, then we recognize that is being made a general request of type
        http://localhost/api/user */
        if (end($this->array) > 0) {
            /* If it is a numeric value, create two variables that contain the requested id and the requested entity
            respectively */
            $this->id = $this->array[count($this->array)];
            $entity = $this->array[count($this->array) - 1];
        } else {
            /* If it is a value of type string, it only creates the variable of the requested entity */
            $entity = $this->array[count($this->array)];
        }

        /* Contain the Api Rest class 's instance */
        $this->api = $this->get_obj();

        /* It establishes in the API object the entity with which it is intended work
        (matches with the table of the same name of the entity in the database) */
        $this->api->entity = $entity;

        /* Analyze the method used in the http request of the four available methods: GET, POST, PUT, DELETE
        and process accordingly */
        switch ($_SERVER['REQUEST_METHOD']) {

            case 'GET':
                $this->actionsForGetMethod();
                break;

            case 'POST':
                $this->actionsForPostMethod();
                break;

            case 'PUT':
                $this->actionsForPutMethod();
                break;

            case 'DELETE':
                $this->actionsForDeleteMethod();
                break;

            default:
                /* In case the requested method is not one of the four available, send the following response */
                $this->print_json(405, "Method Not Allowed", null);
                break;
        }
    }


    /**
     * Is responsible for executing the course of actions for the GET method.
     *
     * @access public
     */
    function actionsForGetMethod()
    {
        if (isset($this->id)) { /* If the variable id exists, it request to the model for the specific element */
            $data = $this->api->get($this->id);
        } else { /* If it does not exist, request all the elements */
            $data = $this->api->get();
        }

        /* It eliminates the last element of the array $ data, since usually, it usually brings two elements,
        one with the information, and another NULL which is not needed */
        array_pop($data);

        if (count($data) == 0) {
            /* If the variable id exists but the array of $ data does not produce a result,
            it means that the element does not exist */
            if (isset($this->id)) {
                $this->print_json(404, "Not Found", null);
            } else {
                /* But if the variable id exists and does not bring $ data, since we do not look for a specific
                element, it means that the entity has no elements to show */
                $this->print_json(204, "Not Content", null);
            }
        } else {
            $this->print_json(200, "OK", $data); /* Print the requested information */
        }
    }


    /**
     * Is responsible for executing the course of actions for the POST method.
     *
     * @access public
     */
    function actionsForPostMethod()
    {
        /* Analyze if the variable id exists, since the URL requested by POST can only be of style 
        http://localhost/api/user It does not have to have an id in the URL since a new element is 
        being registered and the Id is self-generated by data base. If the id does not exist, 
        enter this conditional */
        if (!isset($this->id)) {
            /* Decode the body of the request and save it in an array */
            parse_str(html_entity_decode($this->bodyRequest), $array);

            /* Render the information obtained that will then be saved in the Database */
            $this->api->data = $this->renderizeData(array_keys($array), array_values($array));

            /* Execute the post function that is in the ApiRest class */
            $data = $this->api->post();

            if ($data) {
                /* If the generated id is different from 0 the element was created and enters here */
                if ($this->api->connection->insert_id != 0) {
                    /* The self-generated id is queried to make a callBack */
                    $data = $this->api->get($this->api->connection->insert_id);

                    /* If the variable $ data is equal to 0, it means that the element has not been created as was supposed */
                    if (count($data) == 0) {
                        $this->print_json(201, false, null);
                        /* If the variable $ data is different from 0, the element has been created and sends the following response */
                    } else {
                        array_pop($data);
                        $this->print_json(201, "Created", $data);
                    }

                } else { /* If the generated Id is equal to 0, the element has not been created and sends the following response */
                    $this->print_json(201, false, null);
                }
            } else { /* If the answer is false, it is assumed that the element has not been registered, and enters in this conditional */
                $this->print_json(201, false, null);
            }
        } else { /* If the variable id exists, it will print the message from which the requested method is not correct */
            $this->print_json(405, "Method Not Allowed", null);
        }
    }


    /**
     * Is responsible for executing the course of actions for the PUT method.
     *
     * @access public
     */
    function actionsForPutMethod()
    {
        if (isset($this->id)) {
            /* Check first that there is actually an element with the id before modifying */
            $info = $this->api->get($this->id);
            array_pop($info);

            /* If $info is different from 0, the element exists, therefore proceed to modify */
            if (count($info) != 0) {
                /* Decode the body of the request and save it in an array */
                parse_str(html_entity_decode($this->bodyRequest), $array);

                $this->api->data = $this->renderizeData(array_keys($array), array_values($array));
                $this->api->id = $this->id;
                $data = $this->api->put();

                if ($data) {
                    $data = $this->api->get($this->id);

                    if (count($data) == 0) {
                        $this->print_json(200, false, null);
                    } else {
                        array_pop($data);
                        $this->print_json(200, "OK", $data);
                    }
                } else {
                    $this->print_json(200, false, null);
                }
            } else { /* If $info is equal to 0, the element does not exist and there is nothing to modify */
                $this->print_json(404, "Not Found", null);
            }
        } else {
            $this->print_json(405, "Method Not Allowed", null);
        }
    }


    /**
     * Is responsible for executing the course of actions for the DELETE method.
     *
     * @access public
     */
    function actionsForDeleteMethod(){
        if (isset($this->id)) {
            $info = $this->api->get($this->id);

            if (count($info) == 0) {
                $this->print_json(404, "Not Found", null);
            } else {
                $this->api->id = $this->id;
                $data = $this->api->delete();

                if ($data) {
                    array_pop($info);
                    if (count($info) == 0) {
                        $this->print_json(404, "Not Found", null);
                    } else {
                        $this->print_json(200, "Item deleted", $info);
                    }

                } else {
                    $this->print_json(200, false, null);
                }
            }

        } else {
            $this->print_json(405, "Method Not Allowed", null);
        }
    }


    /**
     * This function create an instance of ApiRest class.
     *
     * @access public
     * @return object ApiRest
     */
    function get_obj()
    {
        $object = new ApiRest;
        return $object;
    }

    
    /**
     * This function renders the information that will be sent to the database
     *
     * @access public
     * @param integer $keys
     * @param string $values
     * @return string
     */
    function renderizeData($keys, $values)
    {
        $str='';
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                foreach ($keys as $key => $value) {
                    if ($key == count($keys) - 1) {
                        $str = $str . $value . ") VALUES (";

                        foreach ($values as $key => $value) {
                            if ($key == count($values) - 1) {
                                $str = $str . "'" . $value . "')";
                            } else {
                                $str = $str . "'" . $value . "',";
                            }
                        }
                    } else {
                        if ($key == 0) {
                            $str = $str . "(" . $value . ",";
                        } else {
                            $str = $str . $value . ",";
                        }
                    }
                }
                return $str;
                break;

            case 'PUT':
                foreach ($keys as $key => $value) {
                    if ($key == count($keys) - 1) {
                        $str = $str . $value . "='" . $values[$key] . "'";
                    } else {
                        $str = $str . $value . "='" . $values[$key] . "',";
                    }
                }
                return $str;
        }
    }


    /**
     * This function print the answers in JSON style and set the status of the HTTP headers
     *
     * @access public
     * @param string $status
     * @param string $message
     * @param string $data
     */
    function print_json($status, $message, $data)
    {
        header("HTTP/1.1 $status $message");
        header("Content-Type: application/json; charset=UTF-8");

        $response['statusCode'] = $status;
        $response['statusMessage'] = $message;
        $response['data'] = $data;

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}
