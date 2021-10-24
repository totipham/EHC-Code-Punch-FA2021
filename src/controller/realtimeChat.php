<?php
require_once "cMessage.php";
require_once "checkPermission.php";

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: ../login.php');
}

if (!isset($_POST['fromID']) || !isset($_POST['toID'])) {
    header('Location: ../index.php');
    exit;
}

$fromID = $_POST['fromID'];
$toID = $_POST['toID'];
$res = "";


$messages = Message::getMessage($fromID, $toID);
foreach ($messages as $mess):
    if ($mess->getFromID() == $fromID):
        $res .= "<div style='text-align:right;'>
        <p style='text-align: left;max-width:260px;height:auto;color:#ffff;background-color:#2cb8aa; word-wrap:break-word; display:inline-block;
        padding:5px; border-radius:10px; max width:70%;'>
        " . $mess->getContent() . "
        </p>
        </div>";
            
    else: 
        $res .= "<div style='text-align:left;'>
            <p style='text-align: right;max-width:260px;height:auto;background-color:#E0E0E0; word-wrap:break-word; display:inline-block;
            padding:5px; border-radius:10px; max width:70%;'>
            " . $mess->getContent() . "
            </p>
            </div>";
    endif;
endforeach;

echo $res;
