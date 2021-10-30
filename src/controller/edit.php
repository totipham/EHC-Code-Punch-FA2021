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

$getDefaultInformation = User::getInfoFromID($id);
$role = $getDefaultInformation->getRole();
$fullname = $getDefaultInformation->getName();
$username = $getDefaultInformation->getUsername();
$email = $getDefaultInformation->getMail();
$phone = $getDefaultInformation->getPhone();
$password = $getDefaultInformation->getPassword();


/* TODO:Only teacher can edit their information as role = teacher */
if ($username != $_SESSION['name'] && $role != 0) {
    header('Location: ../profile?successful=2');
    exit;
}

if ($checkPermission->isTeacher() == 1) {
    $fullname = ($_POST["fullname"] && !empty($_POST["fullname"])) ? $_POST["fullname"] : $fullname;
} else {
    $fullname = $fullname;
}
/* Done check */

/* Set existed information if field is empty */
$email = ($_POST["email"] && !empty($_POST["email"])) ? $_POST["email"] : $email;
$phone = ($_POST["phone"] && !empty($_POST["phone"])) ? $_POST["phone"] : $phone;

if (isset($_POST["password"]) && !empty($_POST["password"])) {
    if ($_POST["password"] != $_POST["repassword"]) {
        header('Location: ../profile?successful=3');
        exit;
    } else {
        $password = md5($_POST["password"]);
    }
}

if ($editInfo = User::editInfo($id, $fullname, $phone, $email, $password) == 1) {
    header('Location: ../profile?studentID=' . $id . '&successful=1');
} else {
    header('Location: ../profile?studentID=' . $id . '&successful=0');
}
