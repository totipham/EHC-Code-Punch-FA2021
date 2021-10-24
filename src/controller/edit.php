<?php
require_once 'checkPermission.php';
require_once 'cUser.php';


$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: ../login');
}

/* Check role, only role = 1 could edit and just update student information */
if ($checkPermission->isTeacher() == 1) {
    $id = $_GET["studentID"] ?? $_SESSION["id"];
} else {
    $id = $_SESSION["id"];
}

/* $query = "SELECT * FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result); */

$getDefaultInformation = User::getInfoFromID($id);
$role = $getDefaultInformation->getRole();
$fullname = $getDefaultInformation->getName();
$username = $getDefaultInformation->getUsername();
$email = $getDefaultInformation->getMail();
$phone = $getDefaultInformation->getPhone();
$password = $getDefaultInformation->getPassword();


/* TODO:Only teacher can edit their information as role = teacher */
if ($username != $_SESSION['name'] && $role != 0) {
    /* echo "<script>alert('You are not allowed to do this!'); window.location = '../';</script>"; */
    header('Location: ../profile?successful=2');
    exit;
}

/* FIXME: Damn, these code under is so fucking dirty */
if ($checkPermission->isTeacher() == 1) {
    $fullname = ($_POST["fullname"] && !empty($_POST["fullname"])) ? $_POST["fullname"] : $fullname;
    $username = ($_POST["username"] && !empty($_POST["username"])) ? $_POST["username"] : $username;
} else {
    $fullname = $fullname;
    $username = $username;
}
/* Done check */

/* Set existed information if field is empty */
$email = ($_POST["email"] && !empty($_POST["email"])) ? $_POST["email"] : $email;
$phone = ($_POST["phone"] && !empty($_POST["phone"])) ? $_POST["phone"] : $phone;

if (isset($_POST["password"]) && !empty($_POST["password"])) {
    if ($_POST["password"] != $_POST["repassword"]) {
        /* echo "<script>alert('Passwords are not matching!'); window.location = '../profile.php';</script>"; */
        header('Location: ../profile?successful=3');
        exit;
    } else {
        $password = md5($_POST["password"]);
    }
}

/* Update information */
/* $sql = $con -> prepare("UPDATE account SET fullname=?, phone=? , email=?, password=? WHERE id=?");
$sql -> bind_param('sissi', $fullname, $phone, $email, $password, $id);
$sql -> execute();
$sql -> close(); */

if ($editInfo = User::editInfo($id, $fullname, $phone, $email, $password) == 1) {
    /* echo "<script>alert('Update information successfully!'); window.location = '../profile.php?studentID=$id';</script>"; */
    header('Location: ../profile?studentID=' . $id . '&successful=1');
} else {
    /* echo "<script>alert('Update information not successfully!'); window.location = '../profile.php?studentID=$id';</script>"; */
    header('Location: ../profile?studentID=' . $id . '&successful=0');
}
