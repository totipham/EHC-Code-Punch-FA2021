<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Dashboard</title></header>";
?>
    <div class="login-form">
        <h2 class="text-center" style="color: red;">Welcome </h2>
        <h2 class="text-center" style="color: red;"><?php echo $_SESSION['fullname']; ?></h2>
        <a href="info.php?ID=<?php echo $_SESSION['id'] ?>">
        <!-- <a href="profile.php"> -->
            <button type="submit" class="btn btn-primary btn-block">View Information</button>
        </a><br>
        <a href='assignment.php'>
            <button type="submit" class="btn btn-primary btn-block">Assignment Management</button>
        </a><br>
        <!-- <a href='challenge.php'>
            <button type="submit" class="btn btn-primary btn-block">Challenge</button>
        </a><br> -->
        <a href='message.php'>
            <button type="submit" class="btn btn-primary btn-block">Message</button>
        </a><br>
        <a href='logout.php'>
            <button type="submit" class="btn btn-primary btn-block">Logout</button>
        </a>
    </div>
    
<?php 
echo file_get_contents ('footer.html'); 

?>
