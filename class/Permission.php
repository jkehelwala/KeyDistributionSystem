<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/8/2018
 * Time: 10:34 PM
 */

class Permission
{
    protected $capabilities;
    protected function __construct($capabilities) {
        $this->capabilities = $capabilities;
    }

    final protected function checkPermission($capability){
        if (!in_array($capability, $this->capabilities))
            throw new Exception("Operation Not Permitted");
    }

    final protected function checkPermissions(){
        $permissions = func_get_args();
        foreach($permissions as $permission){
            if (in_array($permission, $this->capabilities))
                return true;
        }
        throw new Exception("Operation Not Permitted");
    }
}