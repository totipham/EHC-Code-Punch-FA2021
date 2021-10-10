<!DOCTYPE html>
<html lang="en">
<head>
<title>Bootstrap Simple Login Form</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script><style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
	.login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
   
</style>
</head>
<body>
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
    <button onclick="location.href='register_form.php'" type="submit" class="btn btn-primary btn-block">Register</button>
</div>
</body>
</html>   