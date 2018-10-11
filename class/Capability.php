<?php

final class Capability
{
    // EVERYONE
    const DB_READ = 0;
    const VIEW_MACHINES = 1;

    //ADMIN & SYSADMIN
    const VIEW_REQUESTS = 2;

    // USER
    const ADD_REQUEST = 10;
    const VIEW_AUTHORIZED_REQUESTS = 11;
    const VIEW_KEY_FOR_REQUEST = 12;

    // SYSADMIN
    const VIEW_APPROVED_REQUESTS = 20;
    const VIEW_MACHINE_AUTHORIZED_KEYS = 21;
    const ADD_KEY = 22;
    const ISSUE_KEY = 23;

    // ADMIN
    const ADD_MACHINE = 30;
    const VIEW_MACHINE_AUTHORIZED_USERS = 31;
    const APPROVE_REQUEST = 32;

    // TRANSIENT
    const DB_WRITE = 97;
    const ENCRYPT_KEY = 98;
    const DECRYPT_AUTHORIZED_KEY = 99;

}

?>