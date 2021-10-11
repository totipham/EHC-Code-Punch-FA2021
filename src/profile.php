<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
?>
<div class="login-form">
    <form action="update.php" method="POST">
        <h2 class="text-center">Update Profile</h2>
        <div class="form-group">
            <input type="text" class="form-control" name="username" value="<?=$_SESSION['name']?>" disabled>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again">
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="updateButton">Update Information</button>              
    </form>
    <a href="index.php">
    <button type="submit" class="btn btn-primary btn-block">Back to dashboard</button>
    </a>
</div>
<?php
echo file_get_contents ('footer.html'); 
?>