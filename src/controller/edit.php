<?php
require_once 'connection.php';
require_once 'cUser.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

/* Check role, only role = 1 could edit and just update student information */
if ($_SESSION["role"] == 1) {
    $id = $_GET["studentID"] ?? $_SESSION["id"];
} else {
    $id = $_SESSION["id"];
}

$query = "SELECT * FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result);

if ($row->username != $_SESSION['name'] && $row->role != 0) {
    echo "<script>alert('You are not allowed to do this!'); window.location = './';</script>";
    exit;
}

if ($_SESSION["role"] == 1) {
    $fullname = $_POST["fullname"] ?? $row->fullname;
    $username = $_POST["username"] ?? $row->username;
} else {
    $fullname = $row->fullname;
    $username = $row->username;
}
/* Done check */

/* Set existed information if field is empty */
$email = $_POST["email"] ?? $row->email;
$phone = $_POST["phone"] ?? $row->phone;
$password = $_POST["password"];
$repassword = $_POST["repassword"];

if ($password != $repassword){
    echo "<script>alert('Passwords are not matching!'); window.location = './profile.php';</script>";
    exit;
}

$password = isset($_POST["password"]) ? md5($_POST["password"]) : $row->password;

/* Update information */
/* $sql = $con -> prepare("UPDATE account SET fullname=?, phone=? , email=?, password=? WHERE id=?");
$sql -> bind_param('sissi', $fullname, $phone, $email, $password, $id);
$sql -> execute();
$sql -> close(); */

if ($editInfo = User::editInfo($id, $fullname, $phone, $email, $password) == 1) {
    echo "<script>alert('Update information successfully!'); window.location = './profile.php';</script>";
} else {
    echo "<script>alert('Update information not successfully!'); window.location = './profile.php';</script>";
}
?>