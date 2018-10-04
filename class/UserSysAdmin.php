<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 4:00 PM
 */

class UserSysAdmin extends UserAuth
{
    // If implemented, must call parent!
    function __construct($role) {
        parent::__construct($role);
    }

    protected function verifyPrivilege($role)
    {
        // TODO check if the parent user is truly of SysAdmin type. Signature subject to change.
        // Function must be implmeneted in each subuser class to check priviledge before execution
    }

    public function getRequestViews()
    {
        // TODO the to-do items HTML for each user type
    }

    public function getRequests(){

    }
}