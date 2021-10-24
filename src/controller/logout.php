<?php
require_once 'checkPermission.php';
$checkPermission = new checkPermission();

session_destroy();
// Redirect to the login page:
header('Location: ../login');
?>