<!-- PHP Upload File -->
<?php
require_once 'checkPermission.php';
require_once 'cUpload.php';

$checkPermission = new checkPermission();
if ($checkPermission->isLogin() != 1) {
    header('Location: ../login');
}

if ($checkPermission->isTeacher() == 1) {
    $target_dir = "../uploads/";
} else {
    $target_dir = "../uploads/assignment/";
}

if (isset($_GET['game']) && $_GET['game'] == 1) {
    $type = 'challenge';
} else {
    $type = 'assignment';
}

$target_file = $target_dir . basename(preg_replace('/\s+/', '_', $_FILES["assUpload"]["name"]));
$target_file = str_replace(' ', '_', $target_file);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$uploadError = '';

// Check file size
if ($_FILES["assUpload"]["size"] > 1000000) { /* TODO: Allow file <= 1MB */
    $uploadError = $uploadError . "Your file is too large.";
    $uploadOk = 0;
}

// Check if file extension
if ($fileType != "pdf" && $fileType != "txt") { /* TODO: Only accept pdf, txt extension */
    $uploadError = $uploadError . "Only PDF and TXT file are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    header('Location: ../' . $type . '?successful=2');
    exit;
} else {
    if (move_uploaded_file($_FILES["assUpload"]["tmp_name"], $target_file)) {

        if ($checkPermission->isTeacher() == 1) {
            if (isset($_POST["uploadAssignment"])) {
                $assName = $_POST["assName"];
                $res = Upload::uploadAssignment($assName, $target_file);
            } else if (isset($_POST["uploadGame"])) {
                $hint = $_POST["hint"];
                $res = Upload::uploadGame($target_file, $hint);
            }
        } else if ($checkPermission->isTeacher() != 1) { //TODO: Student Role
            $assID = $_POST["assName"];
            $res = Upload::assAnswer($assID, $target_file, $_SESSION['id']);
        }

        if ($res == 1) {
            header('Location: ../' . $type . '?successful=1');
            exit;
        } else if ($res == 2) {
            header('Location: ../' . $type . '?successful=0');
            exit;
        } else if ($res == 0) {
            header('Location: ../' . $type . '?successful=2');
            exit;
        }
    } else {
        header('Location: ../' . $type . '?successful=2');
        exit;
    }
}
?>