<?php
/* require_once "connection.php"; */
require_once 'cMessage.php';

$fromID = $_POST["fromID"];
$toID = $_POST["toID"];
$message = $_POST["message"];

$res = "";
echo $res .= Message::insertToDB($fromID, $toID, $message);
?>