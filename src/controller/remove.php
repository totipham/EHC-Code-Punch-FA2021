<?php
require_once 'checkPermission.php';
require_once 'cUser.php';
require_once 'cAssignment.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: ../login.php');
}

if ($checkPermission->isTeacher() != 1) {
    echo "<script>alert('You are not allowed to access this page!'); window.location = '../index.php';</script>";
    exit;
}

if (isset($_GET["studentID"])) {
    if($remove = User::removeUser($_GET["studentID"])) {
        echo "<script>alert('Remove student successfully'); window.location = '../studentInfo.php';</script>";
    }
} else if (isset($_GET["assID"])) {
    if ($remove = Assignment::removeAss($_GET["assID"])) {
        echo "<script>alert('Remove assignment successfully'); window.location = '../view_assignment.php';</script>";
    }
} else {
    header('Location: ../index.php');
    exit;
}
?>
