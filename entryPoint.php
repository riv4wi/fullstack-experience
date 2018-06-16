<?php

require 'vendor/autoload.php'; /* Load Composer */

header("Access-Control-Allow-Origin: *"); /* Allows connection from any source */
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");  /* Allows the execution of the methods */

$apiRestFul = new sbApi\ApiRestController();