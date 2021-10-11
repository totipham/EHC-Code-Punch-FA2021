<?php
require_once 'connection.php';

if ( !isset($_POST['username'], $_POST['password']) ) { //Check if username and password whether empty or not
	exit('Please fill both the username and password fields!');
}

if ($stmt -> prepare ('SELECT id, password FROM users WHERE username=?')) {
    $stmt -> bind_param ('s', $_POST['username']);
    $stmt -> execute();
    $stmt -> store_result();
    if ($stmt -> num_row > 0) {
        $stmt -> bind_result($id, $password); //
        $stmt -> fetch();
        if (password_verify($_POST['password'], $password)) {
            session_generate_id();
            $_SESSION['logged_in'] = TRUE;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: home.php');
        } else {
            echo "Wrong password";
        }
    } else {
        echo "User not available";
    }
    $stmt -> close();
}