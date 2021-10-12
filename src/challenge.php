<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
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
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>true</td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>false</td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>Larry the Bird</td>
                            <td>true</td>
                            </tr>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    CODE;
} else { /* TODO: Student's Assigment Management */
    //TODO: Put some code in here
    echo "<script>alert('You are not allowed to access this page!'); window.location = './index.php';</script>";
}
?> 
<?php
    echo file_get_contents ("footer.html");
?>