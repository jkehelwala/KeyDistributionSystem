<?php
/* Database Class 
created: 2014-11-11
by : JK;
lastEdited: 2014-11-19
by: JK;
*/

final class DbCon extends Permission
{
    private $con;

    function __construct($capabilities)
    {
        parent::__construct($capabilities);
        $this->checkPermission(Capability::DB_READ);
    }

    public static function minimumPriv($capabilities)
    {
        $instance = new self($capabilities);
        $instance->getReadPriv($capabilities);
        return $instance;
    }

    public static function specificPriv($role, $capabilities)
    {
        $instance = new self($capabilities);
        $instance->getSpecificPriv($role, $capabilities);
        return $instance;
    }

    private function getReadPriv($capabilities)
    {
        $cred = Credentials::Instance($capabilities);
        try {
            $this->con = new PDO("mysql:host=" . $cred->get(Credentials::HOST) . ";dbname=" . $cred->get(Credentials::DB_NAME),
                Credentials::ROLE_MIN_PRIV, $cred->get(Credentials::ROLE_MIN_PRIV));
        } catch (PDOException $pdoE) {
            throw new Exception("Could not connect to the database. " . $pdoE->getMessage());
        }
    }

    private function getSpecificPriv($role, $capabilities)
    {
        $cred = Credentials::Instance($capabilities);
        try {
            $this->con = new PDO("mysql:host=" . $cred->get(Credentials::HOST) . ";dbname=" . $cred->get(Credentials::DB_NAME),
                $role, $cred->get($role));
        } catch (PDOException $pdoE) {
            throw new Exception("Could not connect to the database. " . $pdoE->getMessage());
        }
    }

    function __destruct()
    {
        unset($this->con);
    }

    function runParamQuery($sqlstring, $params)
    {
        $this->checkPermission(Capability::DB_WRITE);
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
        if ($success === false) {
            $this->error($result);
            return false;
        }
        return $result->fetchColumn();
    }

    private function error($result)
    {
        print_r($result->errorInfo()); // Todo Prevent Printing
    }

    private function rowCount($result)
    {
        print_r($result->rowCount());
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
