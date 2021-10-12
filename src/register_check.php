<?php
include 'connection.php';
if($_POST["username"] != '' && $_POST["password"] != '' && $_POST["repassword"] != '' && 
                    $_POST["email"] != '' && $_POST["fullname"] != '' && $_POST['phone'] != '' && $_POST['role'] != '') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];

    $role = $_POST["role"];
    if ($_POST["role"] === "teacher") {
        $role = 1;
    } else {
        $role = 0;
    }

    if ( $password != $repassword){
        echo "Mật khẩu không trùng khớp. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $sql = "SELECT * FROM account WHERE username='$username'";
    $old = mysqli_query($con,$sql);
    $password = md5($password);
    if( mysqli_num_rows($old) > 0){
        echo "Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    if (mysqli_num_rows(mysqli_query($con, "SELECT email FROM account WHERE email='$email'")) > 0) {
        echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $sql = "INSERT INTO account (
        username,
        password,
        fullname,
        email,
        phone,
        role
    )
    VALUE (
        '{$username}',
        '{$password}',
        '{$fullname}',
        '{$email}',
        '{$phone}',
        '{$role}'
    )";
    mysqli_query($con,$sql);
    echo "<h1>Login successfully</h1>";
} else {
    header("location:register.php");
}

echo file_get_contents ('header.html');
echo <<<CODE
    <form action="login.php">
        <input type="submit" class="btn" value="Back to log in">
    </form>
    CODE;
echo file_get_contents ('footer.html'); 
?>