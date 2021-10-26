<?php
require_once 'checkPermission.php';
require_once 'cMessage.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: ../login.php');
}

if (!isset($_POST['fromID']) || !isset($_POST['toID'])) {
    header('Location: ../index.php');
    exit;
}

$fromID = $_POST["fromID"];
$toID = $_POST["toID"];
$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

$res = "";
echo $res .= Message::insertToDB($fromID, $toID, $message);
