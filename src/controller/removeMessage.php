<?php
require_once 'checkPermission.php';
require_once 'cMessage.php';

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

if ($res = Message::removeMessage($fromID, $toID)) {
    echo "";
}
