<?php
require_once 'checkPermission.php';
require_once 'cUser.php';
/* require_once 'connection.php'; */
/* if (!isset($_POST['username'], $_POST['password']) ) {
    echo "<script>alert('Please fill both the username and password fields!'); window.location = './login.php';</script>";
} */
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
