<!-- PHP Upload File -->
<?php
require_once 'connection.php';
/* FIXME: add session check valid */
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
if($fileType != "pdf" && $fileType != "txt") { /* TODO: Only accept pdf, txt extension */
    $uploadError = $uploadError . "Only PDF and TXT file are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    $uploadResult = "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["assUpload"]["tmp_name"], $target_file)) {
        $uploadResult = $uploadResult . "The file has been uploaded!";
        /* TODO: Reg ass to mysql (teacher only) */
        if($_SESSION['role'] == 1) {
            if (isset($_POST["uploadAssignment"])) {
                $assName = $_POST["assName"];
                $sql = $con -> prepare ("INSERT INTO assignment (assName, assFile) VALUES (?, ?)");
                $sql -> bind_param ('ss', $assName, $target_file);
                $sql -> execute();
                $sql -> close();
            } else if (isset($_POST["uploadGame"])) {
                $hint = $_POST["hint"];
                $sql = $con -> prepare ("UPDATE game SET gameFile=?, hint=? WHERE challID=1");
                $sql -> bind_param ('ss', $target_file, $hint);
                $sql -> execute();
                $sql -> close();
            }
        } else if ($_SESSION['role'] == 0) {
            //FIXME: I need something to do as student
            $assID=$_POST["assName"];
            $sql = "INSERT INTO answerass (
                assID,
                assAnswer,
                id
            )
            VALUE (
                '{$assID}',
                '{$target_file}',
                '{$_SESSION['id']}'
            )";
            mysqli_query($con,$sql);
        } else {
            /* FIXME: Need something return if error reg to mysql */
        }

    }else {
        $uploadError = $uploadError . "Sorry, there was an error uploading your file.";
    }
}

echo file_get_contents('header.html');
?>
<header><title>Upload</title></header>
<div class="login-form">
    <div class="form">
        
        <?php 
        if ($uploadOk == 1):
            echo '<h3>' . $uploadResult . '</h3>';
        ?>
        <a href=$target_file>
            <button type="submit" class="btn btn-primary btn-block">View Assignment</button>
        </a><br>
        <?php
        else: 
            echo '<h3>' . $uploadError . '</h3>';
        endif;
        ?>

        <form action='index.php'>   
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
    </div>
</div>

<?php echo file_get_contents('header.html'); ?>  