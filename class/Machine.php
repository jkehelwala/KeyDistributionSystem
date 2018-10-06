<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/6/2018
 * Time: 11:41 PM
 */

class Machine
{
    public $id, $machine_name; // $administrator, $system_administrator;

    function initialize($machineId){
        $this->id = $machineId;
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select m_name, admin_id, sys_admin_id from machines where m_id = ?", [$this->id]);

        $this->machine_name =  $result['m_name'];

//        $this->administrator = new User(); ??
//        $this->administrator->initialize($result['admin_id']);


    }

}