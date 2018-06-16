<?php

namespace sbApi;

use Mysqli;

include 'config.php'; /* Connection credentials */

/**
 * db_model
 *
 * Class to create the connection and execute the queries
 *
 * @author riv4wi
 * @version 1.0
 */
class db_model
{

    public $connection; /* Variable of connection */

    /**
     * Constructor of db_model
     *
     * The constructor function creates and opens the connection when instantiating this class.
     * The parameters of the mysqli () function are the constants previously declared in the
     * config.php file
     *
     * @access public
     */
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    /**
     * Get the SQL string and execute the query
     *
     * @access public
     * @param string $sql
     * @return array
     */
    public function get_query($sql)
    {
        $result = $this->connection->query($sql); /* Get received string and execute the query */
        while ($rows[] = $result->fetch_assoc()) ; /* Fetch a result row as an associative array */
        $result->close();
        return $rows;
    }

    /**
     * Function to execute the query passed by parameter
     * It will only be used for INSERT, UPDATE and DELETE queries
     *
     * @access public
     * @param string $sql
     * @return boolean
     */
    public function set_query($sql)
    {
        return $this->connection->query($sql);
    }

    /**
     * Close the connection opened by constructor
     *
     * @access public
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}