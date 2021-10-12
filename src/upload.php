<!-- PHP Upload File -->
<?php
    if ($_SESSION['role'] == 1) { /* FIXME: check role */
        $target_dir = "uploads/";
    } else {
        $target_dir = "uploads/assignment/";
    }
    $target_file = $target_dir . basename($_FILES["assUpload"]["name"]);
    $target_file = str_replace(' ', '_', $target_file);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadError = '';
    $uploadResult = '';

    // Check file size
    if ($_FILES["assUpload"]["size"] > 1000000) { /* TODO: Allow file <= 1MB */
        $uploadError = $uploadError . "Your file is too large.";
        $uploadOk = 0;
    }

    // Check if file extension
    if($fileType != "pdf" || $fileType != "txt") { /* TODO: Only accept pdf, txt extension */
        $uploadError = $uploadError . "Only PDF file is allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $uploadResult = "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["assUpload"]["tmp_name"], $target_file)) {
            $uploadResult = $uploadResult . "The file has been uploaded!";
        }else {
            $uploadError = $uploadError . "Sorry, there was an error uploading your file.";
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Upload</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<style type="text/css">
	.login-form {
		width: 600px;
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
    <form action='assignment.php'>   
        <?php 
            if ($uploadOk == 1) {
                echo '<h3>' . $uploadResult . '</h3>';           
                echo '<a href=' . $target_file . ' style="">View Assignment</a>';
            } else {
                echo '<h3>' . $uploadError . '</h3>';
            }
        ?>
		<button type="submit" class="btn btn-primary btn-block">Back to dashboard</button>              
    </form>
</div>
</body>
</html>   