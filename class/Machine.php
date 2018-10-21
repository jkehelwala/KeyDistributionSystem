<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/6/2018
 * Time: 11:41 PM
 */

final class Machine extends Permission
{
    private $id, $machine_name, $administrator_id, $system_administrator_id;

    function __construct($capabilities, $machineId)
    {
        parent::__construct($capabilities);
        $this->id = $machineId;
    }

    function initialize()
    {
        $this->checkPermission(Capability::VIEW_MACHINES);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getFirstRow("select m_name, admin_id, sys_admin_id from machines where m_id = ?", [$this->id]);
        $this->machine_name = $result['m_name'];
        $this->administrator_id = $result['admin_id'];
        $this->system_administrator_id = $result['sys_admin_id'];
    }

    public function getKeyIssuedRequests()
    {
        $this->checkPermission(Capability::VIEW_REQUESTS);
        $db = DbCon::minimumPriv($this->capabilities);
        $result = $db->getQueryResult("select r_id from requests where m_id=? and admin_approved=? and key_issued =?", [$this->id, 1, 1]);
        $requests = array();
        foreach ($result as $row) {
            $req = new KeyRequest($this->capabilities, $row['r_id']);
            $req->initialize();
            array_push($requests, $req);
        }
        return $requests;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMachineName()
    {
        return $this->machine_name;
    }

    public function getAdministratorId(){
        return $this->administrator_id;
    }

    public function getSystemAdministratorId()
    {
        return $this->system_administrator_id;
    }


}