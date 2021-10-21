<?php
session_start();
require_once 'controller/cAssignment.php';

/* $query_fetch = "SELECT assName, assFile FROM assignment"; */
/* $query_remove = $con -> prepare("DELETE FROM assignment WHERE assID=?"); */
/* $result = mysqli_query($con, $query_fetch); */


if (!isset($_SESSION['loggedin']) == true) {
	header('Location: login.php');
	exit;
}
echo file_get_contents ('views/header.html');
?>
<header><title>View Assignment</title></header>
<div class="table-form">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">File</th>
            <!-- if ($_SESSION['role'] == 1) {
                echo '<th scope="col">Option</th>';
            }  -->
            </tr>
        </thead>
        <tbody>
        <?php 
            $count = 0;
            $assGiven = Assignment::getAssignment();
            foreach ($assGiven as $ass):
        ?>
            <tr>
                <th scope='row'><?php echo $count+=1; ?></th>
                <td><?php echo $ass->getAssName() ?></td>
                <td><a href=<?php echo $ass->getAssFile();?> >View Assignment</a></td>
                <!-- if ($_SESSION['role'] == 1) {
                    echo '<td><form action="delete.php" method="POST">';
                    echo '<input type="hidden" name="assDelete" value=""/>';
                    echo "<button type='submit' name='assID' value=$row[0]>Delete</button></form></td>";
                }  -->
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container">
  <div class="vertical-center">
        <form action="./">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
  </div>
</div>
<?php echo file_get_contents ('views/footer.html'); ?>