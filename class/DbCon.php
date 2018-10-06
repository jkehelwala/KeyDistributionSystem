<?php
/* Database Class 
created: 2014-11-11
by : JK;
lastEdited: 2014-11-19
by: JK;
*/

class DbCon
{
    private $con;
    private $ini_loc;

    function __construct()
    {
        # Must be set to absolute Path placed outside DOCUMENT_ROOT Todo
        $this->ini_loc = realpath($_SERVER['DOCUMENT_ROOT']."/init/cred.ini");
    }

    public static function minimumPriv()
    {
        $instance = new self();
        $instance->getReadPriv();
        return $instance;
    }

    public static function specificPriv($role)
    {
        $instance = new self();
        $instance->getSpecificPriv($role);
        return $instance;
    }

    protected function getReadPriv()
    {
        $cred = parse_ini_file($this->ini_loc);
        $role = "root"; # todo
        try {
            $this->con = new PDO("mysql:host=". $cred["host"] . ";dbname=". $cred["db"] , $role, $cred[$role]);
        } catch (PDOException $pdoE) {
            throw new Exception("Could not connect to the database. " . $pdoE->getMessage());
        }
    }

    protected function getSpecificPriv($role)
    {
        $cred = parse_ini_file($this->ini_loc);
        try {
            $this->con = new PDO("mysql:host=". $cred["host"] . ";dbname=". $cred["db"] , $role, $cred[$role]);
        } catch (PDOException $pdoE) {
            throw new Exception("Could not connect to the database. " . $pdoE->getMessage());
        }
    }

    // Destructor - Close Connection
    function __destruct()
    {
        unset($this->con);
    }

    function runParamQuery($sqlstring, $params)
    {
        $result = $this->con->prepare($sqlstring);
        $success = $result->execute($params);
        if ($success === false) {
            $this->error($result);
            return false;
        }
        return $result->rowCount();
    }

    function getFirstRow($sqlstring, $params)
    {
        $result = $this->con->prepare($sqlstring);
        $success = $result->execute($params);
        if ($success === false) {
            $this->error($result);
            return false;
        }
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    function getScalar($sqlstring, $params)
    {
        $result = $this->con->prepare($sqlstring);
        $success = $result->execute($params);
        if ($success === false){
            $this->error($result);
            return false;
        }
        return $result->fetchColumn();
    }

    private function error($result){
        print_r($result->errorInfo()); // Todo
    }

    private function rowCount($result){
        print_r($result->rowCount()); // Todo
    }


    function lastInsertID()
    {
        return $this->con->lastInsertId();
    }

    function getQueryResult($sqlstring, $params)
    {
        $result = $this->con->prepare($sqlstring);
        $success = $result->execute($params);
        if ($success === false)
            return false;
        if (!$result)
            return false;
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    
    function escapeString($sqlPara)
    {
        return addcslashes($this->con->quote($sqlPara), '%_');
    }


}

?>
