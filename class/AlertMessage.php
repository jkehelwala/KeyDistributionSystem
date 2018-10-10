<?php

final class AlertMessage{
    private $isError;
    private $message = null;

    public function __construct($isError, $value)
    {
        $this->isError = $isError;
        $this->message = $value;
    }

    public function isError(){
        return $this->isError;
    }

    public function getMessage(){
        if ($this->isError)
            return $this->message->getMessage();
        else
            return $this->message; // Success Message
    }

    public function getException(){
        return $this->message;
    }

}