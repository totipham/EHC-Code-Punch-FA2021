<?php
session_start();
require_once 'cUser.php';

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

if ($_SESSION["role"] != 1) {
    echo "<script>alert('You are not allowed to access this page!'); window.location = './index.php';</script>";
    exit;
}

if ($removeUser = User::removeUser($_GET["studentID"]) == 1) {
    echo "<script>alert('Remove student successfully'); window.location = '../studentInfo.php';</script>";
}

/* echo file_get_contents ('../views/header.html'); */
?>

<!-- <div class=login-form>
    <form action="../">
        <h2 class="text-center">Remove Successfully</h2>
        <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>
    </form>
</div> -->
<!-- <?php echo file_get_contents ('../views/footer.html'); ?> -->