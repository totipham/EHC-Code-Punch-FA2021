<?php
/* require_once 'connection.php'; */
require_once 'cUser.php';

session_start();
if (isset($_SESSION['loggedin'])) {
    header('Location: index.php');
	exit;
}

if (isset ($_SESSION['role'])) {
    if (($_SESSION['role'] == 1) && ($_GET['student'] == 1)) {
        $role = "student";
    }
}

$role = $role ?? $_POST['role'];
$username = $_POST["username"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$email = $_POST["email"];
$fullname = $_POST["fullname"];
$phone = $_POST["phone"];
$id = 0;

if (isset($role, $username, $password, $repassword, $email, $fullname, $phone)) {
    if ($role === "teacher") {
        $role = 1;
    } else {
        $role = 0;
    }

    if ($password != $repassword){
        echo "<script>alert('Passwords are not matching!'); window.location = './register.php';</script>";
        exit;
    }

    $user = new User($fullname, $username, $id, $phone, $email, $password, $role);
    if ($user->addToDB() == 1) {
        echo "<script>alert('Register successfully!'); window.location = './login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Register not successfully!'); window.location = './login.php';</script>";
        exit;
    }

    /* echo $user->addToDB(); */

    /* $sql = "SELECT * FROM account WHERE username='$username'";
    $old = mysqli_query($con,$sql);
    $password = md5($password);
    if( mysqli_num_rows($old) > 0){
        echo "<script>alert('This username is existed!'); window.location = './register.php';</script>";
        exit;
    }
    if (mysqli_num_rows(mysqli_query($con, "SELECT email FROM account WHERE email='$email'")) > 0) {
        echo "<script>alert('This email is existed'); window.location = './register.php';</script>";
        exit;
    }
    $sql = "INSERT INTO account (username, password, fullname, email, phone, role) VALUES ('{$username}', '{$password}', '{$fullname}', '{$email}', '{$phone}', '{$role}')";
    mysqli_query($con,$sql);
} else {
    header("location:register.php"); */
} else {
   
}
?>