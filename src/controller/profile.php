<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

if ($_SESSION["role"] == 1) {
    $id = $_GET["studentID"] ?? $_SESSION["id"];
} else {
    $id = $_SESSION["id"];
}

$query = "SELECT * FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result);
if ($row->username != $_SESSION['name'] && $row->role != 0) {
    echo "<script>alert('You are not allowed to do this!'); window.location = './';</script>";
    exit;
}

echo file_get_contents ('../views/header.html');
?>
<header><title>Profile</title></header>
<div class="login-form">
    <form class="form" action="edit.php?studentID=<?php echo $id; ?>" method="POST">
        <h2 class="text-center"><?php echo $row->username . " 's Profile"; ?></h2>
        <p style="text-align: center;">Edit these fields to update information!</p>
        <?php if ($_SESSION["role"] == 1): ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" value="<?=$row->username?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" value="<?=$row->fullname?>">
            </div>
            <input type="text" class="form-control" name="studentID" value="<?=$id?>" hidden>
        <?php endif; ?>
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="<?=$row->email?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" pattern="[0-9]{3,10}" class="form-control" name="phone" value="<?=$row->phone?>" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="password" pattern="^w+\@w+\.w+$" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again">
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="updateButton">Update Information</button>              
    </form>
    <a href="../">
        <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>
    </a>
</div>
<?php echo file_get_contents ('../views/footer.html'); ?>