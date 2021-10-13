<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$id = $_POST["id"];
$query = "SELECT fullname, email, phone, password FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row1 = mysqli_fetch_array($result);


$fullname = $_POST["fullname"] ?? $row1[0];
$email = $_POST["email"] ?? $row1[1];
$phone = $_POST["phone"] ?? $row1[2];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
if ($password != $repassword){
    echo "<script>alert('Passwords are not matching!'); window.location = './profile.php';</script>";
    exit;
}
$password = isset($_POST["password"]) ? md5($_POST["password"]) : $row1[3];

$sql = $con -> prepare ("UPDATE account SET fullname=?, phone=? , email=?, password=? WHERE id=?");
$sql -> bind_param ('sissi', $fullname, $phone, $email, $password, $id);
$sql -> execute();
$sql -> close();
echo "<script>alert('Update information successfully!'); window.location = './profile.php';</script>";
?>