<?php
require_once 'connection.php';

if ($stmt = $con -> prepare ('SELECT id, password, role FROM account WHERE username=?')) {
    $stmt -> bind_param ('s', $_POST['username']);
    $stmt -> execute();
    $stmt -> store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $role);
        $stmt->fetch();
        if (md5($_POST['password']) === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['role'] = $role;
            header("Location: index.php");
        } else {
            echo 'Incorrect username and/or password!';
        }
    } else {
        echo 'Incorrect username and/or password!';
    }
    $stmt -> close();
}