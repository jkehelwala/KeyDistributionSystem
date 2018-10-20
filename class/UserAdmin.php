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
        $this->capabilities = [Capability::VIEW_MACHINES, Capability::VIEW_REQUESTS,
            Capability::VIEW_MACHINE_AUTHORIZED_USERS,Capability::APPROVE_REQUEST,Capability::ADD_MACHINE];
    }

    // get available key requests to process
    public function getRequestsToProcess()
    {
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getQueryResult("select * from requests where admin_u_id = ?", [1]);
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
}
