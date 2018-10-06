<?php

class User
{
    public $id;
    public $loggedIn;
    protected $username;
    protected $role;
    // private $password;

    function __construct()
    {
        $this->loggedIn = false;
    }


    function login($uname, $password)
    {
        $db = DbCon::minimumPriv();
        $pass_hash = hash('sha256', $password);
        $query = "SELECT count(*) FROM accounts WHERE u_name=? and u_pass=?";
        $result = $db->getScalar($query, [$uname, $pass_hash]);
        if ($result === false)
            throw new Exception("Login Failed.");
        if ($result != 1)
            return false;
        $this->loggedIn = true;
        $this->username = $uname;
        return true;
    }

    function initializeUser()
    {
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select u_id, u_role from accounts where u_name = ?", [$this->username]);
        $this->id = $result['u_id'];
        $this->role = $result['u_role'];
//        $this->password = $result['u_pass'];
    }

    function initialize($id)
    {
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select u_id, u_role, u_name from accounts where u_id = ?", [$id]);
        $this->id = $result['u_id'];
        $this->role = $result['u_role'];
        $this->username = $result['u_name'];
//        $this->password = $result['u_pass'];
    }


    function registration($user, $password, $role_int)
    {
        switch ($role_int) {
            case UserRole::MachineUser:
            case UserRole::Administrator:
            case UserRole::SysAdmin:
                $role = True;
                break;
            default:
                $role = False;
                break;
        }
        if (!$role)
            throw new Exception("Invalid role");

        $pass_hash = hash('sha256', $password);
        $sql = 'INSERT INTO accounts (u_name, u_role, u_pass) VALUES (?, ?, ?)';
        $params = [$user, $role_int, $pass_hash];

        $db = DbCon::minimumPriv();
        $success = $db->runParamQuery($sql, $params);
        if ($success != 1)
            throw new Exception("Registration Unsuccessful");

        $user_id = $db->lastInsertID();
        return $user_id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRoleName()
    {
        return UserRole::OUTPUT[$this->role];
    }

    public function getPartition(){
        return UserRole::PARTITIONS[$this->role];
    }

    public function getUsername()
    {
        return $this->username;
    }


}

?>