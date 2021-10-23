<?php
require ("../vendor/autoload.php");
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}

echo file_get_contents ('views/header.html');
?>
<header><title>Dashboard</title></header>
<div class="login-form">
    <h2 class="text-center">Dashboard</h2>
    <a href='studentInfo.php'>
        <button type="submit" class="btn btn-primary btn-block">Student List</button>
    </a><br>
    <a href='profile.php'>
        <button type="submit" class="btn btn-primary btn-block">Update Information</button>
    </a><br>
    <a href='assignment.php'>
        <button type="submit" class="btn btn-primary btn-block">Assignment Management</button>
    </a><br>
    <a href='challenge.php'>
        <button type="submit" class="btn btn-primary btn-block">Challenge</button>
    </a><br>
    <a href='message.php'>
        <button type="submit" class="btn btn-primary btn-block">Message</button>
    </a><br>
    <a href='controller/logout.php'>
        <button type="submit" class="btn btn-primary btn-block">Logout</button>
    </a>
</div>

<?php echo file_get_contents ('views/footer.html'); ?>