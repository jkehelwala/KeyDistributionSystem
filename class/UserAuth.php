<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 3:55 PM
 */

abstract class UserAuth extends Permission
{
    protected $id;
    function __construct($role, $id) {
       parent::__construct([]);
       $this->verifyPrivilege($role);
       $this->id = $id;
       $this->setCapabilities();
    }

    public static function factory ($role, $id) {
        $userAuth = NULL;
        switch ($role){
            case UserRole::SysAdmin:
                $userAuth = new UserSysAdmin($role, $id);
                break;
            case UserRole::Administrator:
                # Todo
                break;
            case UserRole::MachineUser:
                # Todo
                break;
        }
        return $userAuth;
    }

    abstract protected function verifyPrivilege($role);
    abstract protected function setCapabilities();
    abstract public function getRequestsToProcess();
}