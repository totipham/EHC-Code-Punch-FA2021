<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
$query_fetch1 = "SELECT id, result FROM gameans";
$query_fetch2 = $con -> prepare("SELECT fullname FROM account WHERE id=?");
$result = mysqli_query($con, $query_fetch1);

echo file_get_contents('header.html');
echo "<header><title>Challenge</title></header>";
if ($_SESSION['role'] == 1) { /* FIXME: check role by $SESSION['role']*/
    echo <<<CODE
    <div class="row"> 
        <div class="col-md">
            <div class="upload-form">
                <form action="upload.php" method="POST" enctype= "multipart/form-data">
                    <div class="form-group">
                        <h2 class="text-center">Upload Challenge</h2>  
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="fileUpload" require="required">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Hint</span>
                                </div>
                                <textarea class="form-control" name="hint"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Upload</button> 
                    </div>
                </form>
                <a href="index.php">
                    <button type="submit" class="btn btn-primary btn-block">Back to dashboard</button>              
                </a>
            </div>
        </div>
        <div class="col-md">
            <div class="upload-form">
                <div class="form-group"><br>
                    <h2 class="text-center">Student Result</h2>
CODE;
echo <<<CODE
                <div class="table-form">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
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
                                    $query_fetch2->bind_result($student);
                                    $query_fetch2->fetch();
                                echo $assName;
                                echo '</td>';
                                echo '<td>'; 
                                   echo $row[1]; 
                                echo '</td>';
                            echo '</tr>';
                        }
                        $query_fetch2 -> close();
echo <<<CODE
                        </tbody>
                        </table>
                </div>
    CODE;
} else { /* TODO: Student's Assigment Management */
    //TODO: Put some code in here
    echo <<<CODE
    <div class="upload-form">
        <form action="upload.php" method="POST">
            <div class="form-group">
                <h2 class="text-center">Answer Challenge</h2>  
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hint</span>
                        </div>
                        <textarea class="form-control" name="hint" placeholder='Hello Konichiwa' disabled></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Answer" required="required">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button> 
            </div>
        </form>
        <a href="index.php">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </a>
    </div>
    CODE;
}
?> 
<?php
    echo file_get_contents ("footer.html");
?>