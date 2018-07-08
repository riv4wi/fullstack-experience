<?php

namespace Api;

/**
 * Class that executes calls to the execution functions to interact with the Database.
 *
 * This class inherits properties and methods of the class db_model in the file db_model.php and implements the
 * iApiRest interface (Which determines the methods that an ApiRest object should have)
 *
 * @author riv4wi
 * @version 1.0
 */
class ApiRest extends db_model implements iApiRest
{
    public $entity;   /* The entity that represents the table to use */
    public $data;     /* The information that was sent to the Database */
    public $id;       /* Contain the id of entity or element */

    /**
     * This function will be activated when using the GET method.
     * Used to obtain data of an entity or a list of them
     *
     * If the value of the parameter is equal to 0, all the elements will be requested since specific element
     * has not been requested
     *
     * @access public
     * @param integer $id
     * @return array - Return a row as an associative array
     */
    public function get($id = 0)
    {
        if ($id == 0) {
            return $this->get_query(sprintf("
                SELECT 
                * 
                FROM 
                %s",
                $this->entity));
        } else {
            /* If the value of the id parameter is different from 0, only the element
            whose id is equal to the received parameter will be requested */
            return $this->get_query(sprintf("
                SELECT 
                * 
                FROM 
                %s 
                WHERE 
                id = %d", $this->entity, $id));
        }
    }

    /**
     * This function will be activated when using the POST method.
     * Used to insert an entity or element
     *
     * @access public
     * @return boolean
     */
    public function post()
    {
        $sql=sprintf("INSERT INTO  %s %s", $this->entity, $this->data);
        return $this->set_query($sql);
    }

    /**
     * This function will be activated when using the PUT method.
     * Used to update an entity or element
     * @access public
     * @return boolean
     */
    public function put()
    {
        return $this->set_query(sprintf("
            UPDATE 
            %s 
            SET 
            %s 
            WHERE 
            id = %d", $this->entity, $this->data, $this->id));
    }

    /**
     * This function will be activated when using the DELETE method.
     * Used to deleted an entity or element
     * @access public
     * @return boolean
     */
    public function delete()
    {
        return $this->set_query(sprintf("
            DELETE FROM 
            %s 
            WHERE 
            id = %d",
            $this->entity, $this->id));
    }
}
