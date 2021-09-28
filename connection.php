<?php
$serverDB='localhost';
$usernameDB='root';
$passwordDB='';
$nameDB='login';

$con = mysqli_connect($serverDB, $usernameDB, $passwordDB, $nameDB);
if (mysqli_connect_errno ()){
    exit ("Failed to connect to MySQL ".  mysqli_connect_error());
}