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
    function __construct($role, $id) {
        parent::__construct($role, $id);
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
            Capability::ENCRYPT_KEY, Capability::ADD_KEY, Capability::ISSUE_KEY];
    }

    public function getRequestsToProcess()
    {
        $this->checkPermission(Capability::VIEW_APPROVED_REQUESTS);
        $db = DbCon::minimumPriv();
        $result = $db->getQueryResult("select r_id from requests where admin_approved=? and key_issued =?", [1,0]);
        $keyRequests = array();
        foreach ($result as $row) {
            array_push($keyRequests, $this->getRequest($row['r_id']));
        }
        return $keyRequests;
    }

    private function getRequest($id){
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $req = new KeyRequest($this->capabilities, $id);
        $req->initialize();
        return $req;
    }

    public function getAccessibleRequest($id)
    {
        $req = $this->getRequest($id);
        if ($this->id != $req->machine->system_administrator_id || !$req->approved || $req->issued) {
            echo boolval($this->id != $req->machine->system_administrator_id);
            echo boolval(!$req->approved);
            echo boolval($req->issued);
            throw new Exception("Operation Not Permitted");
        }
        return $req;
    }

    public function addKey($request_id, $key, $maintainer_note){
        $newKey = new MachineKey($this->capabilities, $request_id);
        $success = $newKey->addKey($key, $maintainer_note);
        if(!$success)
            throw new Exception("Operation Failed.");
        $req = new KeyRequest($this->capabilities, $request_id);
        $success = $req->issueKey();
        if(!$success)
            throw new Exception("Operation Failed.");
        return $success;
    }

}