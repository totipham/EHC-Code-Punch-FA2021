<?php
require_once 'connection.php';

$query_fetch1 = "SELECT * FROM answerass";
$query_fetch2 = $con -> prepare("SELECT assName FROM assignment WHERE assID=?");
$query_fetch3 = $con -> prepare("SELECT fullname FROM account WHERE id=?");
$result = mysqli_query($con, $query_fetch1);
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
                            <th scope="col">Assignment</th>
                            <th scope="col">Student</th>
                            <th scope="col">Answer</th>
CODE;
                            /* if ($_SESSION['role'] == 1) {
                                echo '<th scope="col">Option</th>';
                            } */
echo <<<CODE
                            </tr>
                        </thead>
                        <tbody>
CODE;
                        while($row = mysqli_fetch_array($result)) { /* row[0] assID, row[1] assAnswer, row[2] id */
                            echo '<tr>';
                                echo '<th scope="row">';
                                    echo $count+=1;
                                echo '</th>';
                                echo '<td>';
                                    $query_fetch2 -> bind_param ('i', $row[0]);
                                    $query_fetch2 -> execute();
                                    $query_fetch2 -> store_result();
                                    $query_fetch2->bind_result($assName);
                                    $query_fetch2->fetch();
                                echo $assName;
                                echo '</td>';
                                echo '<td>'; /* bind_param -> student */
                                    $query_fetch3 -> bind_param ('i', $row[2]);
                                    $query_fetch3 -> execute();
                                    $query_fetch3 -> store_result();
                                    $query_fetch3->bind_result($studentName);
                                    $query_fetch3->fetch();
                                    echo $studentName;
                                echo '</td>';
                                echo '<td>'; 
                                    echo "<a href=$row[1]>";
                                        echo 'View Assignment'; 
                                    echo "</a>";
                                echo '</td>';
                            echo '</tr>';
                        }
                        $query_fetch2 -> close();
                        $query_fetch3 -> close();
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