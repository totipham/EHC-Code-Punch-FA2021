<?php
require_once 'connection.php';

$query_fetch = "SELECT assName, assFile FROM assignment";
/* $query_remove = $con -> prepare("DELETE FROM assignment WHERE assID=?"); */
$result = mysqli_query($con, $query_fetch);
$count = 0;

if (!isset($_SESSION['loggedin']) == true) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('header.html');
echo "<header><title>View Assignment</title></header>";
echo <<<CODE
                <div class="table-form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">File</th>
CODE;
                            /* if ($_SESSION['role'] == 1) {
                                echo '<th scope="col">Option</th>';
                            } */
echo <<<CODE
                            </tr>
                        </thead>
                        <tbody>
CODE;
                        while($row = mysqli_fetch_array($result)) {
                            echo '<tr>';
                                echo '<th scope="row">';
                                echo $count+=1;
                                echo '</th>';
                                echo '<td>';
                                echo $row[0];
                                echo '</td>';
                                echo '<td>';
                                    echo "<a href=$row[1]>";
                                        echo 'View Assignment';
                                    echo '</a>';
                                echo '</td>';
                                /* if ($_SESSION['role'] == 1) {
                                    echo '<td><form action="delete.php" method="POST">';
                                    echo '<input type="hidden" name="assDelete" value=""/>';
                                    echo "<button type='submit' name='assID' value=$row[0]>Delete</button></form></td>";
                                } */
                            echo '</tr>';
                        }
echo <<<CODE
                        </tbody>
                        </table>
                </div>
    CODE;
?>
<div class="container">
  <div class="vertical-center">
        <form action="index.php"> <!-- FIXME: Need a page to header -->
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
  </div>
</div>
<?php
echo file_get_contents ('footer.html'); 
?>