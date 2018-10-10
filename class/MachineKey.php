<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/8/2018
 * Time: 6:13 PM
 */

final class MachineKey extends Crypts
{
    private $request_id;
    private $notes;
    private $crypt_key;

    function __construct($capabilities, $request_id)
    {
        parent::__construct($capabilities);
        $this->request_id = $request_id;
    }

    public function getKey()
    {
        $this->checkPermission(Capability::VIEW_KEY_FOR_REQUEST);
        return $this->decrypt($this->crypt_key);
    }

    private function setKey($plain_text)
    {
        $this->checkPermission(Capability::ADD_KEY);
        $this->crypt_key = $this->encrypt($plain_text);
    }

    function initialize()
    {
        $this->checkPermissions(Capability::VIEW_KEY_FOR_REQUEST, Capability::VIEW_MACHINE_AUTHORIZED_KEYS);
        $db = DbCon::minimumPriv();
        $result = $db->getFirstRow("select enc_key, self_notes, key_hash from key_list where r_id = ?", [$this->request_id]);
        $this->crypt_key = $result['enc_key'];
        $this->notes = $result['self_notes'];
        $this->setTag($result['key_hash']);
    }

    function addKey($key, $notes)
    {
        $this->checkPermission(Capability::ADD_KEY);
        $this->setKey($key);
        $this->notes = $notes;
        $sql = 'INSERT INTO key_list (r_id, enc_key, self_notes, key_hash) VALUES (?, ?, ?, ?)';
        $params = [$this->request_id, $this->crypt_key, $this->notes, $this->getTag()];
        $db = DbCon::minimumPriv();
        $success = $db->runParamQuery($sql, $params);
        if ($success != 1)
            throw new Exception("Could not add key.");
        return true;
    }


    public function getRequestId()
    {
        return $this->request_id;
    }

    public function getNotes()
    {
        return $this->notes;
    }

}

