<?php
session_start();
if (isset($_SESSION['loggedin']) == true) {
	header('Location: index.php');
	exit;
}
echo file_get_contents ('header.html');
?>
<header><title>Login</title></header>
<div class="login-form">
    <form class="form" action="authentication.php" method="POST">
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

<?php echo file_get_contents ('footer.html'); ?>