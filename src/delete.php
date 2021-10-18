<?php
require 'connection.php';
$conn = dbConnect::ConnectToDB();
$stuID = $_GET['ID'];
$check = "SELECT * FROM account WHERE id='$stuID';";
if (!mysqli_query($conn, $check)) {
    die('Failed: ' . mysqli_error($conn));
} else {
    $info = mysqli_fetch_assoc(mysqli_query($conn, $check));
    if ($info['role'] == 1) {
        echo "<script>alert('Can not delete a teacher'); window.location = 'studentInfo.php';</script>";
    } else {
        $sql = "DELETE FROM account WHERE id='$stuID';";
        if (!mysqli_query($conn, $sql)) {
            die('Failed: ' . mysqli_error($conn));
        }
        echo "<script>alert('Deleted'); window.location = 'studentInfo.php';</script>";
    }
}
?>
<br />
<a href="studentInfo.php">Back</a>
