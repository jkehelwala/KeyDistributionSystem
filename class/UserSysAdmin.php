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
        if (!in_array(Capability::VIEW_APPROVED_REQUESTS, $this->capabilities))
            throw new Exception("Operation Not Permitted");
        $db = DbCon::minimumPriv();
        $result = $db->getQueryResult("select r_id from requests where admin_approved=? and key_issued =?", [1,0]);
        $keyRequests = array();
        foreach ($result as $row) {
            $req = new KeyRequest();
            $req->initialize( $row['r_id']);
            array_push($keyRequests, $req);
        }
        return $keyRequests;
    }

    protected function requestView()
    {
        // TODO Request object with allowed actions
    }
}