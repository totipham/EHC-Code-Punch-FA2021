<?php
require("../vendor/autoload.php");
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}

echo file_get_contents('views/header.php');
?>
<header>
    <title>Dashboard</title>
</header> 
<div class="login-form">
    <h2 class="text-center">Welcome Back, <?= htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?></h2><br>
    <a href='student'>
        <button type="submit" class="btn btn-success btn-block">User List</button>
    </a><br>
    <a href='assignment'>
        <button type="submit" class="btn btn-success btn-block">Assignment Management</button>
    </a><br>
    <a href='challenge'>
        <button type="submit" class="btn btn-success btn-block">Challenge</button>
    </a><br>
</div>

<?php echo file_get_contents('views/footer.php'); ?>
