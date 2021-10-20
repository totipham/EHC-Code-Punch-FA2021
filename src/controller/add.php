<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
	exit;
}
echo file_get_contents ('../views/header.html');
?>
<header><title>Add student</title></header>

<div class="login-form">
    <form class="form" action="register_check.php?student=1" method="POST">
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
</div>

<?php echo file_get_contents ('../views/footer.html'); ?>