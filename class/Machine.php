<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/6/2018
 * Time: 11:41 PM
 */

class Machine
{
    public $id, $machine_name, $administrator_id, $system_administrator_id;

    function initialize($machineId){
        $this->id = $machineId;
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select m_name, admin_id, sys_admin_id from machines where m_id = ?", [$this->id]);
        $this->machine_name =  $result['m_name'];
        $this->administrator_id =$result['admin_id'];
        $this->system_administrator_id = $result['sys_admin_id'];
    }

}