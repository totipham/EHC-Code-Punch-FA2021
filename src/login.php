<?php
session_start();
if (isset($_SESSION['loggedin']) == true) {
	header('Location: index.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Login</title></header>";
echo <<<CODE
    <div class="login-form">
        <form action="authentication.php" method="post">
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
    CODE;

echo file_get_contents ('footer.html'); 
?>

// Edited
<?php
session_start();
if (isset($_SESSION['loggedin']) == true) {
	header('Location: index.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Login</title></header>";

require_once 'student.php';

$conn = dbConnect::ConnectToDB();

if(isset($_SESSION['loggedin']) == true){
    if($_SESSION['role'] == true){
        header("Location: teacherPanel.php");
        die();
    }else{
        header("Location: studentPanel.php");
    }
}


?>
    <div class="login-form">
        <form action="authentication.php" method="post">
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
    
<?php
echo file_get_contents ('footer.html'); 
?>
