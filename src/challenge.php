<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

echo file_get_contents('header.html');
echo "<header><title>Challenge</title></header>";

if ($_SESSION['role'] == 1): /* FIXME: check role by $SESSION['role']*/
    $count = 0;
    $query_fetch1 = "SELECT id, result FROM gameans";
    $result = mysqli_query($con, $query_fetch1); ?>
    <div class="row"> 
        <div class="col-md">
            <div class="upload-form">
                <form action="upload.php" method="POST" enctype= "multipart/form-data">
                    <input type="text" name="uploadGame" value="1" hidden>
                    <div class="form-group">
                        <h2 class="text-center">Upload Challenge</h2>  
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="assUpload" require="required">
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
                    <div class="table-form">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student</th>
                                <th scope="col">Result</th>
                                <!-- /* if ($_SESSION['role'] == 1) {
                                    echo '<th scope="col">Option</th>';
                                } */ -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $query_fetch2 = $con -> prepare("SELECT fullname FROM account WHERE id =?");
                            while($row = mysqli_fetch_array($result)): 
                                $query_fetch2 -> bind_param ('i', $row[0]);
                                $query_fetch2 -> execute();
                                $query_fetch2 -> store_result();
                                $query_fetch2->bind_result($student);
                                $query_fetch2->fetch(); ?>
                                <!-- /* row[0] assID, row[1] assAnswer, row[2] id */ -->
                                <tr>
                                    <th scope="row">
                                        <?php echo $count+=1; ?>
                                    </th>
                                    <td>
                                        <?php echo $student; ?>
                                    </td>
                                    <td>
                                        <?php echo ($row[1] == 1) ? "true" : "false"; ?>
                                    </td>
                                </tr>
                            <?php endwhile; 
                            $query_fetch2 -> close(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php /* TODO: Student's Assigment Management */
    else:
        $query_fetch3 = "SELECT hint, gameFile FROM game WHERE challID=1";
        $result = mysqli_query($con, $query_fetch3);
        $row_ans = mysqli_fetch_array($result); //$row_ans[0]
?> 
    <div class="upload-form">
        <form action="challenge.php" method="POST">
            <div class="form-group">
                <h2 class="text-center">Answer Challenge</h2>  
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hint</span>
                        </div>
                        <textarea class="form-control" name="hint" placeholder="<?= $row_ans[0] ?? "Empty"; ?>" disabled></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="gameAns" placeholder="Answer" required="required">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button> 
            </div>
        </form>
        <a href="index.php">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </a>
    </div>
<?php /* TODO: Check answer */
endif;
if (isset($_POST["gameAns"])) {
    $answer = $_POST["gameAns"];
}

if (isset($answer)) {
    if ("uploads/" . $answer === $row_ans[1]) {
        $result = 1;        
    } else {
        $result = 0;
    }
    $sql = $con -> prepare ("UPDATE gameans SET result=? WHERE id=?");
    $sql -> bind_param ('ii', $result, $_SESSION['id']);
    $sql -> execute();
    $sql -> close();
}
echo file_get_contents ("footer.html");
?>