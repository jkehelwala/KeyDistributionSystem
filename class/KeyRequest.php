<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 4:24 PM
 */

class KeyRequest
{
    public $id;
    public $requesting_user;
    public $machine;
    public $key_type;
    public $responding_admin;
    public $approved;
    public $issued;

    function initialize($requestId){
        $this->id = $requestId;
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select u_id, m_id, key_type, admin_u_id, admin_approved, key_issued from requests where r_id = ?", [$this->id]);

        $this->requesting_user = new User();
        $this->requesting_user->initialize($result['u_id']);
        $this->responding_admin = new User();
        $this->responding_admin->initialize($result['admin_u_id']);
        $this->machine = new Machine();
        $this->machine->initialize($result['m_id']);

        $this->key_type = $result['key_type'];
        $this->approved = $result['admin_approved'];
        $this->issued = $result['key_issued'];


    }

}