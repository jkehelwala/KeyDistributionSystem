<?php
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
$user->authorizeView(UserRole::Administrator);
echo "Admin Dashboard";