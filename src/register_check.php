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

    if ($_POST["role"] === "teacher") {
        $role = 1;
    } else {
        $role = 0;
    }

    if ( $password != $repassword){
        echo "<script>alert('Passwords are not matching!'); window.location = './register.php';</script>";
        exit;
    }
    $sql = "SELECT * FROM account WHERE username='$username'";
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
} else {
    header("location:register.php");
}

echo file_get_contents ('header.html');
echo <<<CODE
    <div class=login-form>
        <form action="login.php">
            <h2 class="text-center">Register Successfully</h2>
            <button type="submit" class="btn btn-primary btn-block">Back to login</button>
        </form>
    </div>
    CODE;
echo file_get_contents ('footer.html'); 
?>

// new code 
<?php
include 'connection.php';
include 'student.php';
$con =dbConnect::ConnectToDB();
if (
    $_POST["username"] != '' && $_POST["password"] != '' && $_POST["repassword"] != '' &&
    $_POST["ID"] != '' && $_POST["email"] != '' && $_POST["fullname"] != '' && $_POST['phone'] != '' && $_POST['role'] != ''
) {
    $username = $_POST["username"];
    $id = $_POST["ID"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];
    $email = $_POST["email"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];

    if ($_POST["role"] === "teacher") {
        $role = 1;
    } else {
        $role = 0;
    }

    if ($password != $repassword) {
        echo "<script>alert('Passwords are not matching!'); window.location = './register.php';</script>";
        exit;
    }
    $sql = "SELECT * FROM account WHERE username='$username'";
    $old = mysqli_query($con, $sql);
    $password = $password;
    if (mysqli_num_rows($old) > 0) {
        echo "<script>alert('This username is existed!'); window.location = './register.php';</script>";
        exit;
    }
    if (mysqli_num_rows(mysqli_query($con, "SELECT email FROM account WHERE email='$email'")) > 0) {
        echo "<script>alert('This email is existed'); window.location = './register.php';</script>";
        exit;
    }
    $InsertSql = "INSERT INTO account (
        id,
        username,
        password,
        fullname,
        email,
        phone,
        role
    )
    VALUE (
        '{$id}',
        '{$username}',
        '{$password}',
        '{$fullname}',
        '{$email}',
        '{$phone}',
        '{$role}'
    );";
    
    if(!mysqli_query($con, $InsertSql)){
        die('Failed: '.mysqli_error($con));
    }else{
        echo "Done";
    }
    

} else {
    header("location:register.php");
}

echo file_get_contents('header.html');
?>



    <div class=login-form>
        <form action="login.php">
            <h2 class="text-center">Register Successfully</h2>
            <button type="submit" class="btn btn-primary btn-block">Back to login</button>
        </form>
    </div>


<?php
echo file_get_contents('footer.html');
?>
