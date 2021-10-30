<?php
require_once 'checkPermission.php';
require_once 'cUser.php';


$checkPermission = new checkPermission();
if($checkPermission->isLogin() == 1) {
    header('Location: ../');
}

if (($checkPermission->isTeacher() == 1) && ($_GET['student'] == 1)) {
    $role = "student";
}


$role = $role ?? $_POST['role'];
$username = $_POST["username"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];
$email = $_POST["email"];
$fullname = $_POST["fullname"];
$phone = $_POST["phone"];
$id = 0;

if (!is_email($email) && !is_name($fullname) && !is_phone($phone) && !is_username($username)) {
    header('Location: ../student?addstatus=4');
    exit;
}

if (isset($role, $username, $password, $repassword, $email, $fullname, $phone)) {
    if ($role === "teacher") {
        $role = 1;
    } else {
        $role = 0;
    }

    if ($password != $repassword){
        header('Location: ../student?addstatus=3');
        exit;
    }

    $user = new User($fullname, $username, $id, $phone, $email, $password, $role);
    if ($user->addToDB() == 1) {
        header('Location: ../student?addstatus=1');
        exit;
    } else {
        header('Location: ../student?addstatus=0');
        exit;
    }
} else {
   
}


function is_email($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/", $str)) ? FALSE : TRUE;
}

function is_username($str) {
    return (!preg_match("/^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/", $str)) ? FALSE : TRUE;
}

function is_phone($str) {
    return (!preg_match("/^[0-9]{9,11}/", $str)) ? FALSE : TRUE;
}

function is_name($str) {
    return (!preg_match("/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂẾưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s\W|_]+$/", $str)) ? FALSE : TRUE;
}
