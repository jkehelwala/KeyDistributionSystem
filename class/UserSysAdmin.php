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
        if ($role != UserRole::SysAdmin)
            throw new Exception("Operation Not Permitted");
    }

    protected function setCapabilities()
    {
        $this->capabilities = [Capability::VIEW_MACHINES, Capability::VIEW_REQUESTS,
            Capability::VIEW_APPROVED_REQUESTS, Capability::VIEW_MACHINE_AUTHORIZED_KEYS,
            Capability::ENCRYPT_KEY, Capability::ADD_KEY];
    }

    public function getRequestsToProcess()
    {
        // TODO
    }

    protected function requestView()
    {
        // TODO Request object with allowed actions
    }
}