<?php
require_once 'connection.php';
session_start();
$conn = dbConnect::ConnectToDB();
$stuID = $_GET['ID'];
$sql = "SELECT * FROM account WHERE id='$stuID';";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Failed' . mysqli_error($conn));
}
$info = mysqli_fetch_assoc($result);
// echo file_get_contents ('header.html');
?>
<html>
<style>
    body {
        background-color: aquamarine;
    }

    input {
        width: 70%;
        height: 5%;
        border: 10px;
        border-radius: 5px;
        padding: 4px 10px 4px 10px;
        margin: 8px 0px 10px 0px;
        box-shadow: 1px 1px 2px 1px;
    }
</style>

<body>
    <h2>Edit Information</h2>

    <tr>
        <form action="" method="POST">
            <input type="text" name="fullname" placeholder="Enter new full name" / require><br>
            <input type="text" name="username" placeholder="Enter new user name" / require><br>
            <input type="text" name="id" placeholder="Enter new ID" / require><br>
            <input type="text" pattern="[0-9]{10}" name="phone" placeholder="Enter new phone number" /><br>
            <input type="text" pattern="^w+\@w+\.w+$" name="email" placeholder="Enter new email" /><br>

            
            <input type="submit" style="background-color:darkseagreen;" name="update" value="Submit" />
        </form>


        <?php

        if (isset($_POST['update'])) {

            $sql = "UPDATE account SET username = '$_POST[username]', fullname='$_POST[fullname]', id = '$_POST[id]', phone=$_POST[phone] , email='$_POST[email]' WHERE id = '$stuID';";

            if (!mysqli_query($conn, $sql)) {
                die('Failed: ' . mysqli_error($conn));
            }
            $stuID = $_POST['id'];
            $_SESSION['id'] = $_POST['id'];

            echo "Done";
        }

        ?>

    </tr>
    <br />
    <a href='info.php?ID=<?php echo $stuID ?>'>Back</a>
</body>

</html>
