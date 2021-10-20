<?php
session_start();
$server='localhost';
$usernameDB='root';
$passwordDB='';
$nameDB='users';

$con = mysqli_connect($server, $usernameDB, $passwordDB, $nameDB);
if (mysqli_connect_errno ()){
    exit ("Failed to connect to MySQL ".  mysqli_connect_error());
}
