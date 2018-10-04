<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 3:55 PM
 */

abstract class UserAuth
{
    function __construct($role) {
       $this->verifyPrivilege($role);
    }
    abstract protected function verifyPrivilege($role);
    abstract public function getRequestViews();
}