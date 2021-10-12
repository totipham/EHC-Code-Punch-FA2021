<?php
session_start();
$serverDB='localhost';
$usernameDB='root';
$passwordDB='';
$nameDB='users';

$con = mysqli_connect($serverDB, $usernameDB, $passwordDB, $nameDB);
if (mysqli_connect_errno ()){
    exit ("Failed to connect to MySQL ".  mysqli_connect_error());
}
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}