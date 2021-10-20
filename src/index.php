<?php
require("../vendor/autoload.php");
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: controller/login.php');
	exit;
}
echo file_get_contents ('views/header.html');
echo "<header><title>Dashboard</title></header>";
?>
<div class="login-form">
    <h2 class="text-center">Dashboard</h2>
    <a href='controller/studentInfo.php'>
        <button type="submit" class="btn btn-primary btn-block">Student List</button>
    </a><br>
    <a href='controller/profile.php'>
        <button type="submit" class="btn btn-primary btn-block">Update Information</button>
    </a><br>
    <a href='controller/assignment.php'>
        <button type="submit" class="btn btn-primary btn-block">Assignment Management</button>
    </a><br>
    <a href='controller/challenge.php'>
        <button type="submit" class="btn btn-primary btn-block">Challenge</button>
    </a><br>
    <a href='controller/message.php'>
        <button type="submit" class="btn btn-primary btn-block">Message</button>
    </a><br>
    <a href='controller/logout.php'>
        <button type="submit" class="btn btn-primary btn-block">Logout</button>
    </a>
</div>

<?php echo file_get_contents ('views/footer.html'); ?>