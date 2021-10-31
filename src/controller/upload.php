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

$fileType = strtolower(pathinfo($_FILES["assUpload"]["name"], PATHINFO_EXTENSION));
$target_file = $target_dir . bin2hex(random_bytes(16)) . '.' . $fileType;

if (isset($_GET['game']) && $_GET['game'] == 1) {
    $type = 'challenge';
    $target_file = $target_dir . basename(preg_replace('/\s+/', '_', $_FILES["assUpload"]["name"]));
} else {
    $type = 'assignment';
}

$target_file = str_replace(' ', '_', $target_file);
$uploadOk = 1;

$uploadError = '';

// Check file size
if ($_FILES["assUpload"]["size"] > 10000) { /* TODO: Allow file <= 10KB */
    header('Location: ../' . $type . '?s=3');
    exit;
}

// Check if file extension
if ($fileType != "pdf" && $fileType != "txt") { /* TODO: Only accept pdf, txt extension */
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    header('Location: ../' . $type . '?s=2');
    exit;
} else {
    if (move_uploaded_file($_FILES["assUpload"]["tmp_name"], $target_file)) {
        if ($checkPermission->isTeacher() == 1) {
            if (isset($_POST["uploadAssignment"])) { //TODO: Teacher Given Assignment
                if (isset($_POST["assName"]) && !empty($_POST["assName"])) {
                    $assName = $_POST["assName"];
                    $res = Upload::uploadAssignment($assName, $target_file);
                } else {
                    $res = 0;
                }
            } else if (isset($_POST["uploadGame"])) { //TODO: Teacher Given Game
                if (isset($_POST["hint"]) && !empty($_POST["hint"])) {
                    $hint = $_POST["hint"];
                    $res = Upload::uploadGame($target_file, $hint);
                } else {
                    $res = 0;
                }
            }
        } else if ($checkPermission->isTeacher() != 1) { //TODO: Student Upload Assignment
            if (isset($_POST["assName"]) && !empty($_POST["assName"])) {
                $assID = $_POST["assName"];
                $res = Upload::assAnswer($assID, $target_file, $_SESSION['id']);
            } else {
                $res == 0;
            }
        }

        if ($res == 1) {
            header('Location: ../' . $type . '?s=1');
            exit;
        } else if ($res == 2) {
            header('Location: ../' . $type . '?s=0');
            exit;
        } else if ($res == 0) {
            header('Location: ../' . $type . '?s=2');
            exit;
        }
    } else {
        header('Location: ../' . $type . '?s=2');
        exit;
    }
}
?>