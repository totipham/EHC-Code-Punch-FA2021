<?php
require_once 'checkPermission.php';
require_once 'cChat.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: ../login');
}

if (!isset($_POST['toID'])) {
    header('Location: ../index');
    exit;
}

$fromID = $_SESSION['id'];
$toID = $_POST["toID"];
$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

if ($res = Chat::insertToDB($fromID, $toID, $message)) {
    echo "";
}
