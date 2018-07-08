<?php

namespace Api;

/**
 * iApiRest Interface
 *
 * Define each of the functions that the ApiRest.php must have
 *
 * @author riv4wi
 * @version 1.0
 */
interface iApiRest
{
    // GET : Get an element
    public function get();

    // POST : Insert an element
    public function post();

    // PUT: Update an element
    public function put();

    // DELETE: Delete an element
    public function delete();
}
