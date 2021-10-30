<?php
require_once 'controller/checkPermission.php';

$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}

if ($checkPermission->isTeacher() != 1) {
    echo "<script>alert('You are not allowed to access this page!'); window.location = 'index';</script>";
    exit;
}

echo file_get_contents('views/header.php');
?>
<header>
    <title>Add student</title>
</header>

<div class="login-form">
    <form class="form" action="controller/addcheck.php?student=1" method="POST">
        <h2 class="text-center">Add student</h2>
        <div class="form-group">
            <input type="text" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" class="form-control" name="fullname" placeholder="Fullname" required="required">
        </div>
        <div class="form-group">
            <input type="email" pattern="^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input pattern="[0-9]{9,11}" title="A good phone number will be contained 9-11 digits" type="text" class="form-control" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="text" pattern="^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$" title="A good username will be contained 8-20 characters!" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add</button>
    </form>
    <button onclick="location.href='student'" type="submit" class="btn btn-primary btn-block">Back to Student</button>
</div>

<?php echo file_get_contents('views/footer.php'); ?>