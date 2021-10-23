<?php
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() == 1) {
    header('Location: index.php');
}
echo file_get_contents ('views/header.html');
?>
<header><title>Login</title></header>
<div class="login-form">
    <form class="form" action="controller/authentication.php" method="POST">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Log in</button>              
    </form>
    <button onclick="location.href='register.php'" type="submit" class="btn btn-primary btn-block">Register</button>
</div>

<?php echo file_get_contents ('views/footer.html'); ?>