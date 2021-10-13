<?php
require_once 'connection.php';

echo $_POST["assID"];

if ($stmt = $con -> prepare ("DELETE FROM assignment WHERE assID=?")) {
    
    $stmt -> bind_param ('i', $_POST["assID"]);
    $stmt -> execute();
    $stmt -> close();
    echo "Error";
} else {
    //echo "Error";
}
 
?>