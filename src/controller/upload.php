<!-- PHP Upload File -->
<?php
require_once 'checkPermission.php';
require_once 'cUpload.php';

if($checkPermission->isLogin() != 1) {
    header('Location: ../login.php');
}

if ($checkPermission->isTeacher() == 1) {
    $target_dir = "../uploads/";
} else {
    $target_dir = "../uploads/assignment/";
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
if($fileType != "pdf" && $fileType != "txt") { /* TODO: Only accept pdf, txt extension */
    $uploadError = $uploadError . "Only PDF and TXT file are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $uploadResult = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["assUpload"]["tmp_name"], $target_file)) {
        $uploadResult = $uploadResult . "The file has been uploaded!";
        if($checkPermission->isTeacher() == 1) {
            if (isset($_POST["uploadAssignment"])) {
                $assName = $_POST["assName"];
                $uploadAss = Upload::uploadAssignment($assName, $target_file);

            } else if (isset($_POST["uploadGame"])) {
                $hint = $_POST["hint"];
                $uploadGame = Upload::uploadGame($target_file, $hint);
            }
        } else if ($checkPermission->isTeacher() != 1) {
            $assID=$_POST["assName"];$uploadAnsAss = Upload::assAnswer($assID, $target_file, $_SESSION['id']);
        }
    }else {
        $uploadError = $uploadError . "Sorry, there was an error uploading your file.";
    }
}

echo file_get_contents('../views/header.html');
?>
<header><title>Upload</title></header>
<div class="login-form">
    <div class="form">
        <?php 
        if ($uploadOk == 1):
            echo '<h3>' . $uploadResult . '</h3>';
        ?>
        <a href= <?php echo $target_file ?>>
            <button type="submit" class="btn btn-primary btn-block">View Assignment</button>
        </a><br>
        <?php
        else: 
            echo '<h3>' . $uploadError . '</h3>';
        endif;
        ?>

        <form action='../'>   
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
    </div>
</div>

<?php echo file_get_contents('../views/header.html'); ?>  