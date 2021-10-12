<?php
require_once 'connection.php';
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
echo file_get_contents('header.html');
echo "<header><title>Assignment</title></header>";
if ($_SESSION['role'] == 1) { /* Teacher's Assignment Management */
    echo <<<CODE
    <div class="row"> 
        <div class="col-md">
            <div class="upload-form">
                <form action="upload.php" method="POST" enctype= "multipart/form-data">
                    <div class="form-group">
                        <h2 class="text-center">Upload Assignment</h2>  
                        <div class="form-group">
                            <input type="text" class="form-control-file" name="assName" placeholder="Assignment Name" required="required">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="assUpload" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Upload</button> 
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md">
            <div class="upload-form">
                <div class="form-group"><br>
                    <h2 class="text-center">Assignment Management</h2><br>
                    <a href="submitted.php">
                        <button type="submit" class="btn btn-primary btn-block">Student's Assignment</button> 
                    </a>
                    <br>
                    <a href="view_assignment.php">
                        <button type="submit" class="btn btn-primary btn-block">My Assignment</button> 
                    </a>
                </div>
            </div>
        </div>
    </div>
    CODE;
} else { /* TODO: Student's Assigment Management */
    $query = "SELECT assID, assName FROM assignment";
    $result = mysqli_query($con, $query);
    echo <<<CODE
    <div class="row">
        <div class="col-md">
            <div class="upload-form">
                <div class="form-group">
                    <form action="view_assignment.php" method="POST" enctype= "multipart/form-data">
                        <h2 class="text-center">Assignment Management</h2>  
                        <br><br>
                        <button type="submit" class="btn btn-primary btn-block">View Assignment</button> 
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="upload-form">
                <form action="upload.php" method="POST" enctype= "multipart/form-data">
                    <div class="form-group">
                        <h2 class="text-center">Answer</h2>
                        <div class="form-group">
                            <select class="form-control" name="assName" required>
    CODE;
    while($row1 = mysqli_fetch_array($result)) {
        echo '<option value="';
        echo $row1[0];
        echo '">';
        echo $row1[1];
        echo '</option>';
    }
    echo <<<CODE
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="assUpload" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Upload</button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
    CODE;
}
?>  

<div class="container">
  <div class="vertical-center">
        <form action="index.php"> <!-- FIXME: Need a page to header -->
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
  </div>
</div>

<?php
    echo file_get_contents ("footer.html");
?>