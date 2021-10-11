<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
echo <<<CODE
    <div class="login-form">
        <a>Student's List</a>
    </div>
    CODE;
echo file_get_contents ('footer.html'); 
?>