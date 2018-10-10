<?php
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
$user->authorizeView(UserRole::MachineUser);
echo "Machine User Dashboard";