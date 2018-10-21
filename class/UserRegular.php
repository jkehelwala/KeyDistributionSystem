<?php
//@author: NiroshJ

final class UserRegular extends UserAuth
{
    // If implemented, must call parent!
    function __construct($role, $id)
    {
        parent::__construct($role, $id);
    }

    // previlage verification
    protected function verifyPrivilege($role)
    {
        if ($role != UserRole::MachineUser)
            throw new Exception("Operation Not Permitted");
    }

    // set capabilities for Administrator 
    protected function setCapabilities()
    {
        $this->capabilities = [Capability::DB_READ, Capability::VIEW_MACHINES, Capability::ADD_REQUEST,
                                Capability::VIEW_AUTHORIZED_REQUESTS, Capability::VIEW_KEY_FOR_REQUEST];
    }

    public function addRequest($requestId, $keyType){
        $this->checkPermissions(Capability::ADD_REQUEST);
        $sql = "INSERT INTO requests (u_id, m_id, key_type, admin_u_id, key_issued) VALUES (?, ?, ?, ?, ?)";
        $params = [$this->id, $requestId, $keyType, $this->getMachine($requestId)->getAdministratorId(), 0];
        array_push($this->capabilities, Capability::DB_WRITE);
        $db = DbCon::minimumPriv($this->capabilities);
        $success = $db->runParamQuery($sql, $params);
        array_pop($this->capabilities);
        if ($success != 1)
            throw new Exception("Could not add request!");
        return true;
    }

    public function getMachines(){
        $this->checkPermissions(Capability::VIEW_MACHINES);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getQueryResult("SELECT m_id FROM machines WHERE ?", [1]);
        $macRequests = array();
        foreach($result as $row){
            array_push($macRequests, $this->getMachine($row["m_id"]));
        }
        return $macRequests;
    }

    private function getMachine($id){
        $this->checkPermissions(Capability::VIEW_MACHINES);
        $mac = new Machine($this->capabilities, $id);
        $mac->initialize();
        return $mac;
    }

    public function getKeyIssuedRequests(){
        $this->checkPermissions(Capability::VIEW_KEY_FOR_REQUEST);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getQueryResult("SELECT r.r_id, m.m_name FROM machines as m, requests as r WHERE r.m_id=m.m_id AND r.u_id=? AND r.admin_approved=? AND r.key_issued=?", [$this->id, 1, 1]);
        $issuedReq = array();
        array_push($this->capabilities, Capability::DECRYPT_AUTHORIZED_KEY);
        array_push($this->capabilities, Capability::ENCRYPT_KEY);
        foreach($result as $row){
            $mk = new MachineKey($this->capabilities, $row["r_id"]);
            $mk->initialize();
            $temp = array();
            array_push($temp, $row["m_name"]);
            array_push($temp, $mk);
            array_push($issuedReq, $temp);
        }
        array_pop($this->capabilities);
        array_pop($this->capabilities);
        return $issuedReq;
    }

    public function getKeyForRequest($requestId){
        
    }

    public function getRequestsToProcess(){

    }


}
