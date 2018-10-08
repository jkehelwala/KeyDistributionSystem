<?php

abstract class Capability
{
    // EVERYONE
    const VIEW_MACHINES = 0;

    //ADMIN & SYSADMIN
    const VIEW_REQUESTS = 1;

    // USER
    const ADD_REQUEST = 10;
    const VIEW_AUTHORIZED_REQUESTS = 11;
    const VIEW_KEY_FOR_REQUEST = 12;
    const DECRYPT_AUTHORIZED_KEY = 13;

    // SYSADMIN
    const VIEW_APPROVED_REQUESTS = 20;
    const VIEW_MACHINE_AUTHORIZED_KEYS = 21;
    const ENCRYPT_KEY = 22;
    const ADD_KEY = 23;
    const ISSUE_KEY = 24;

    // ADMIN
    const ADD_MACHINE = 30;
    const VIEW_MACHINE_AUTHORIZED_USERS = 31;
    const APPROVE_REQUEST = 32;

}

?>