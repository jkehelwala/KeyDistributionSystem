<?php
/**
 * @author [Dilini Gunasena]
 * @email [dilini@omobio.net]
 * @create date 2018-10-10 15:54:51 
 * @desc [description]
*/
final class UserAdmin extends UserAuth
{
    // If implemented, must call parent!
    function __construct($role, $id)
    {
        parent::__construct($role, $id);
    }

    // previlage verification
    protected function verifyPrivilege($role)
    {
        if ($role != UserRole::Administrator)
            throw new Exception("Operation Not Permitted");
    }

    // set capabilities for Administrator 
    protected function setCapabilities()
    {
        $this->capabilities = [Capability::DB_READ,Capability::VIEW_MACHINES, Capability::VIEW_REQUESTS,
            Capability::VIEW_MACHINE_AUTHORIZED_USERS,Capability::APPROVE_REQUEST,Capability::ADD_MACHINE];
    }

    // get available key requests to process
    public function getRequestsToProcess()
    {
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $db = DbCon::minimumPriv($this->capabilities);
        //TODO:and admin_approved is null
        $result = $db->getQueryResult("select * from requests where admin_u_id = ? ", [1]);
        $keyRequests = array();        
        foreach ($result as $row) {
            array_push($keyRequests, $this->getRequest($row['r_id']));
        }
        //print_r($keyRequests);
        return $keyRequests;
    }

    // get available key requests 
    private function getRequest($id)
    {
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $req = new KeyRequest($this->capabilities, $id);
        $req->initialize();
        return $req;
    }

    public function changeKeyStatus($request_id, $status){
        $this->checkPermission(Capability::APPROVE_REQUEST);
        switch($status){
            case 1:
                $sql = "UPDATE requests SET admin_approved=? WHERE r_id=?";
                $params = [$status, $request_id];
                return $this->dbWrite($sql, $params);
                break;
            case 2:
                $sql = "DELETE FROM requests WHERE r_id=?";
                $params = [$request_id];
                $firstResult = $this->dbWrite($sql, $params);
                $sql = "DELETE FROM key_list WHERE r_id=?";
                return $this->dbWrite($sql, $params) && $firstResult;
                break;
            case 0:
                $sql = "DELETE FROM requests WHERE r_id=?";
                $params = [$request_id];
                return $this->dbWrite($sql, $params);
        }
        return false;
    }

    private function dbWrite($sql, $params){
        array_push($this->capabilities, Capability::DB_WRITE);
        $db = DbCon::minimumPriv($this->capabilities);
        $success = $db->runParamQuery($sql, $params);
        array_pop($this->capabilities);
        if ($success != 1)
            throw new Exception("Key could not be approved!");
        return true;
    }
}
