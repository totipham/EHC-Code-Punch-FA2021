<?php
require_once "cMessage.php";

$fromID = $_POST['fromID'];
$toID = $_POST['toID'];
$res = "";

$messages = Message::getMessage($fromID, $toID);
foreach ($messages as $mess):
    if ($mess->getFromID() == $fromID):
        $res .= "<div style='text-align:right;'>
        <p style='text-align: left;max-width:260px;height:auto;color:#ffff;background-color:#004C99; word-wrap:break-word; display:inline-block;
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

?>