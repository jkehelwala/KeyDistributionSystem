<?php
/**
 * @author [NiroshJ]
 * @desc [The class mimics the behavior of regular user
 *      who can request the keys for machines available]
*/
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
                                Capability::VIEW_AUTHORIZED_REQUESTS, Capability::VIEW_KEY_FOR_REQUEST, Capability::VIEW_REQUESTS];
    }

    /**
     * @param requestId id of the requested machine
     * @param keyType type of the key
     * @return boolean true for success or false for failure
     * @desc [the method will add the entry in requests table
     *      for requesting the key for a machine]
     */
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

    /**
     * @return macRequests array of Machine instances
     * @desc [the method returns all the machines available]
     */
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

    /**
     * @param id the id of the machine
     * @return mac initialized Machine instance
     * @desc [private helper method and return the 
     *      initialized instance of Machine]
     */
    private function getMachine($id){
        $this->checkPermissions(Capability::VIEW_MACHINES);
        $mac = new Machine($this->capabilities, $id);
        $mac->initialize();
        return $mac;
    }

    /**
     * @return issuedReq array containing MachineKey and Machine objects
     * @desc [method will return the Machine and MachineKey initialized
     *        instances whose keys are issued by Sys Admin]
     */
    public function getKeyIssuedRequests(){
        $this->checkPermissions(Capability::VIEW_KEY_FOR_REQUEST);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getQueryResult("SELECT r_id, m_id FROM requests WHERE u_id=? AND admin_approved=? AND key_issued=?", [$this->id, 1, 1]);
        $issuedReq = array();
        array_push($this->capabilities, Capability::DECRYPT_AUTHORIZED_KEY);
        array_push($this->capabilities, Capability::ENCRYPT_KEY);
        foreach($result as $row){
            $mk = new MachineKey($this->capabilities, $row["r_id"]);
            $mk->initialize();
            $mac = new Machine($this->capabilities, $row["m_id"]);
            $mac->initialize();
            $req = new KeyRequest($this->capabilities,  $row["r_id"]);
            $req->initialize();
            $temp = array();
            array_push($temp, $mac);
            array_push($temp, $mk);
            array_push($temp, $req);
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
