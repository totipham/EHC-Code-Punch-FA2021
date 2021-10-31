<?php
require_once 'checkPermission.php';
require_once 'cUser.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() == 1) {
    header('Location: ../');
}

$username = $_POST['username'];
$password = $_POST['password'];

if (!isset($username, $password)) {
    header('Location: ../login?status=2');
}
if ($userLogin = User::checkInfo($username, $password) == 1) {
    header("Location: ../");
} else {
    header('Location: ../login?status=0');
}
