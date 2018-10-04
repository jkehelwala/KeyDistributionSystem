<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 3:55 PM
 */

abstract class UserAuth
{
    function __construct() {
       $this->verifyPrivilege();
    }
    abstract protected function verifyPrivilege();
    abstract protected function getRequests();
}