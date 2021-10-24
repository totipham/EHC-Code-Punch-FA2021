<?php
require_once 'checkPermission.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: ../');
}

if ($checkPermission->isTeacher() != 1) {
    echo "<script>alert('You are not allowed to access this page!'); window.location = '../';</script>";
    exit;
}

echo file_get_contents ('../views/cHeader.php');
?>
<header><title>Add student</title></header>

<div class="login-form">
    <form class="form" action="addcheck.php?student=1" method="POST">
        <h2 class="text-center">Add student</h2>     
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Fullname" required="required">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Add</button>              
    </form>
    <button onclick="location.href='../student'" type="submit" class="btn btn-primary btn-block">Back to Student</button>
</div>

<?php echo file_get_contents ('../views/footer.php'); ?>