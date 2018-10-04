<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 4:00 PM
 */

class UserSysAdmin extends UserAuth
{
// No Constructor for the child class so that parent constructor is called! If implemented, must call parent!
//    function __construct() {}

    protected function verifyPrivilege()
    {
        // TODO
        // Function must be implmeneted in each subuser class to check priviledge before execution
    }

    protected function getRequests()
    {
        // TODO
    }
}