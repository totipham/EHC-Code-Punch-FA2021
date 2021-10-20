<?php
session_start();
require_once 'cUser.php';
/* require_once 'connection.php'; */
/* if (!isset($_POST['username'], $_POST['password']) ) {
    echo "<script>alert('Please fill both the username and password fields!'); window.location = './login.php';</script>";
} */


if (isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
	exit;
}

$username = $_POST['username'];
$password = $_POST['password'];
if (!isset($username, $password)) {
    echo "<script>alert('Please fill both the username and password fields!'); window.location = 'login.php';</script>";
}
if ($userLogin = User::checkInfo($username, $password) == 1) {
    header("Location: ../index.php");
} else {
    echo "<script>alert('Incorrect username and/or password!'); window.location = 'login.php';</script>";
}

/* echo $userLogin = User::checkInfo($_POST['username'], $_POST['password']);
 */
/* if ($stmt = $con -> prepare ('SELECT id, password, role FROM account WHERE username=?')) {
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
            echo "<script>alert('Incorrect username and/or password!'); window.location = './login.php';</script>";
        }
    } else {
        echo "<script>alert('Incorrect username and/or password!'); window.location = './login.php';</script>";
    }
    $stmt -> close();
} */