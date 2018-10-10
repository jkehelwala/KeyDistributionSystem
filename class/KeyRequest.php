<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 4:24 PM
 */

final class KeyRequest extends Permission
{
    public $id;
    public $requesting_user;
    public $machine;
    public $key_type;
    public $responding_admin;
    public $approved;
    public $issued;

    function __construct($capabilities, $request_id)
    {
        parent::__construct($capabilities);
        $this->id = $request_id;
    }

    function initialize(){
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select u_id, m_id, key_type, admin_u_id, admin_approved, key_issued from requests where r_id = ?", [$this->id]);
        $this->requesting_user = new User();
        $this->requesting_user->initialize($result['u_id']);
        $this->responding_admin = new User();
        $this->responding_admin->initialize($result['admin_u_id']);
        $this->machine = new Machine($this->capabilities, $result['m_id']);
        $this->machine->initialize();

        $this->key_type = $result['key_type'];
        $this->approved = $result['admin_approved'];
        $this->issued = $result['key_issued'];
    }

    function issueKey(){
        $this->checkPermission(Capability::ISSUE_KEY);
        $sql = "UPDATE requests SET key_issued=? WHERE r_id = ? and key_issued=? and admin_approved=?";
        $params = [1, $this->id, 0, 1];
        $db = DbCon::minimumPriv();
        $success = $db->runParamQuery($sql, $params);
        if ($success != 1)
            throw new Exception("Could not update request");
        return true;
    }

    function getIssuedKey(){
        if(!$this->issued)
            throw new Exception("Request Invalid");
        $this->checkPermission(Capability::VIEW_MACHINE_AUTHORIZED_KEYS);
        $key = new MachineKey($this->capabilities, $this->id);
        $key->initialize();
        return $key;
    }

}