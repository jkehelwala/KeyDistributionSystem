<?php

final class User
{
    private $id;
    private $loggedIn;
    private $username;
    private $role;
    private $actions = NULL;

    // private $password;

    function __construct()
    {
        $this->loggedIn = false;
    }

    public function isLoggedIn()
    {
        return $this->loggedIn;
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

    public function getDashboardLink()
    {
        return '/users/' . $this->getPartition() . '/dashboard.php';
    }

    public function getLogout()
    {
        return '/index.php?logout=1';
    }

    public function authorizeView($view_owner)
    {
        if (!$this->loggedIn || $this->getRole() != $view_owner)
            throw new Exception("Access Denied");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getRoleName()
    {
        return UserRole::OUTPUT[$this->role];
    }

    public function getPartition()
    {
        return UserRole::PARTITIONS[$this->role];
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getActions()
    {
        if (!$this->loggedIn)
            throw new Exception("User must be logged in");
        // If user object is not logged in, allowed actions can't be obtained.
        if ($this->actions === NULL)
            $this->setActions();
        return $this->actions;
    }

    public function setActions()
    {
        $this->actions = UserAuth::factory($this->role, $this->id);
    }
}

?>