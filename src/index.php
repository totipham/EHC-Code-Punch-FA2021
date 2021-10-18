<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Dashboard</title></header>";
echo <<<CODE
    <div class="login-form">
        <h2 class="text-center">Dashboard</h2>
        <a href='student.php'>
            <button type="submit" class="btn btn-primary btn-block">Student List</button>
        </a><br>
        <a href='profile.php'>
            <button type="submit" class="btn btn-primary btn-block">Update Information</button>
        </a><br>
        <a href='assignment.php'>
            <button type="submit" class="btn btn-primary btn-block">Assignment Management</button>
        </a><br>
        <a href='challenge.php'>
            <button type="submit" class="btn btn-primary btn-block">Challenge</button>
        </a><br>
        <a href='message.php'>
            <button type="submit" class="btn btn-primary btn-block">Message</button>
        </a><br>
        <a href='logout.php'>
            <button type="submit" class="btn btn-primary btn-block">Logout</button>
        </a>
    </div>
    CODE;

echo file_get_contents ('footer.html'); 
// Edited
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 1) {
	header('Location: teacherPanel.php');
	exit;
}
if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 0) {
	header('Location: studentPanel.php');
	exit;
}
echo file_get_contents ('header.html');
 
echo file_get_contents ('footer.html'); 

?>
?>
