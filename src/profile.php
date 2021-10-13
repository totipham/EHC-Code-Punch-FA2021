<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
$id = $_SESSION['id'];
$query = "SELECT email, phone, fullname FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row1 = mysqli_fetch_array($result);

echo file_get_contents ('header.html');
?>
<header><title>Profile</title></header>
<div class="login-form">
    <form class="form" action="edit.php" method="POST">
        <h2 class="text-center">Update Profile</h2>
        <input type="text" class="form-control" name="id" value="<?=$id?>" hidden>
        <div class="form-group">
            <input type="text" class="form-control" name="username" value="<?=$_SESSION['name']?>" disabled>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" value="<?=$row1[2]?>" disabled>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="<?=$row1[0]?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" pattern="[0-9]{3,10}" class="form-control" name="phone" value="<?=$row1[1]?>" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="password" pattern="^w+\@w+\.w+$" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again">
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="updateButton">Update Information</button>              
    </form>
    <a href="index.php">
        <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>
    </a>
</div>
<?php echo file_get_contents ('footer.html'); ?>