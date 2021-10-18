<?php
session_start();
if (isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>Register</title></header>";
?>
    <div class="login-form">
        <form action="register_check.php" method="POST">
            <h2 class="text-center">Register</h2>     
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Fullname" required="required">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="ID" placeholder="User ID" required="required">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" pattern="^w+\@w+\.w+$" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="phone" pattern="[0-9]{10}" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <select class="form-control" name="role" required>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again" required="required">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>              
        </form>
        <button onclick="location.href='login.php'" type="submit" class="btn btn-primary btn-block">Login</button>
    </div>
  
<?php
echo file_get_contents ('footer.html'); 
?>
