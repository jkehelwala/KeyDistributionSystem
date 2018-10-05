<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/4/2018
 * Time: 3:55 PM
 */

abstract class UserAuth
{
    protected $capabilities; //Array of Capabilities initiated with setCapabilities()
    function __construct($role) {
       $this->verifyPrivilege($role);
       $this->setCapabilities();
    }
    abstract protected function verifyPrivilege($role);
    abstract protected function setCapabilities();
    abstract protected function requestView();
    abstract public function getRequestsToProcess();
}