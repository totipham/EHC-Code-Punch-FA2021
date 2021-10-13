<?php
require_once 'connect.php';
session_start();
$conn = dbConnect::ConnectToDB();
$stuID = $_GET['studentID'];
$sql = "SELECT * FROM student WHERE studentID='$stuID';";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die('Failed' . mysqli_error($conn));
}
$info = mysqli_fetch_assoc($result);
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
            <input type="text" name="stName" placeholder="Enter new name" / require><br>
            <input type="text" name="stID" placeholder="Enter new ID" / require><br>
            <input type="text" pattern="[0-9]{10}" name="stPhone" placeholder="Enter new phone number" /><br>
            <input type="text" pattern="^w+\@w+\.w+$" name="stEmail" placeholder="Enter new email" /><br>
            <input type="submit" style="background-color:darkseagreen;" name="update" value="Submit" />
        </form>


        <?php
        // Student::editInfo($stuID);
        if (isset($_POST['update'])) {
            // echo $name = $_POST['stName'];
            // echo  $ID = $_POST['stID'];
            // echo  $phone = $_POST['stPhone'];
            // echo $email = $_POST['stEmail'];

            // $student = new Student($name, $ID, $infor['assignment'], $info['score'], $phone, $email, $info['password'], $info['isAdmin']);
            // $student->editInfo($stuID);
          




            $sql = "UPDATE student SET name='$_POST[stName]', studentID = '$_POST[stID]', phone=$_POST[stPhone] , email='$_POST[stEmail]' WHERE studentID = '$stuID';";

            if (!mysqli_query($conn, $sql)) {
                die('Failed: ' . mysqli_error($conn));
            }
            $stuID = $_POST['stID'];
            // $_SESSION['ID'] = $stuID;
            echo "Done";
        }

        ?>

    </tr>
    <br />
    <a href='./info.php?studentID=<?php echo $stuID ?>'>Back</a>
</body>

</html>