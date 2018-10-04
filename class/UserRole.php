<?php

abstract class UserRole
{
    const Administrator = 0;
    const SysAdmin = 1;
    const MachineUser = 2;
    const PARTITIONS = ["admin", "sysadmin", "regular"];
    const OUTPUT = ["Administrator", "System Administrator", "Machine User"];
}

?>