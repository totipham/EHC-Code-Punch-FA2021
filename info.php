<?php
session_start();
require_once 'connect.php';
$conn = dbConnect::ConnectToDB();
$stuID = $_GET['studentID'];

$sql = "SELECT * FROM student WHERE studentID='$stuID';";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Failed' . mysqli_error($conn));
}
$info = mysqli_fetch_assoc($result);

?>
<html style="background-color: aquamarine;">
<?php include('./template/header.php') ?>

<body>
    <h2>Information of <span style="color:red"><?php echo $info['name'] ?></span></h2>

    <table border="1">
        <tbody>
            <tr>
                <td>Student name</td>
                <td>Student ID</td>
                <td>Phone number</td>
                <td>Email</td>
            </tr>
            <tr>
                <td><?php echo $info['name'] ?></td>
                <td><?php echo $info['studentID'] ?></td>
                <td><?php echo $info['phone'] ?></td>
                <td><?php echo $info['email'] ?></td>

            </tr>

        </tbody>
    </table>
    <?php

    if ($_SESSION['role'] == true) {
        echo '<form class="" action="delete.php?studentID=' . $info['studentID'] . '" method="post">' . '
            <button type="submit" name="button">Delete</button>
        </form>';

        echo '<form class="" action="edit.php?studentID=' . $info['studentID'] . '" method="post">' .
            '<button type="submit" name="button">Update</button>';
    } else {
        echo '<form class="" action="edit.php?studentID=' . $info['studentID'] . '" method="post">' .
            '<button type="submit" name="button">Update</button></form>';
    }
    ?>

    <br>
    <a href='../'>Back</a>
</body>

</html>