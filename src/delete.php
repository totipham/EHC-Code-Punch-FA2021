<?php
require 'connection.php';
$conn = dbConnect::ConnectToDB();
$stuID = $_GET['ID'];

$sql = "DELETE FROM account WHERE id='$stuID';";
if(!mysqli_query($conn, $sql)){
    die('Failed: '.mysqli_error($conn));
}
echo "Done";
header("Refresh:4, location: studentInfo.php")
?>
<br/>
<a href="studentInfo.php">Back</a>
