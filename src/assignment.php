<?php
    echo file_get_contents('header.html');
    if ($SESSION['role'] == true) { /* FIXME: check role */
        echo <<<CODE
        <div class="row">
            <div class="col-md">
                <div class="upload-form">
                    <form action="upload.php" method="POST" enctype= "multipart/form-data">
                        <div class="form-group">
                            <h2 class="text-center">Upload Assignment</h2>  
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="fileUpload" require="required">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Upload</button> 
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md">
                <div class="upload-form">
                    <div class="form-group"><br>
                        <h2 class="text-center">Assignment Management</h2>  <br>
                        <a href="view_assignment.php">
                            <button type="submit" class="btn btn-primary btn-block">Student's Assignment</button> 
                        </a>
                        <br>
                        <a href="my_assignment.php">
                            <button type="submit" class="btn btn-primary btn-block">My Assignment</button> 
                        </a>
                    </div>
                </div>
            </div>
        </div>
        CODE;
    } else {
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
                                <input type="file" class="form-control-file" name="fileUpload" require="required">
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
        <form action="./"> <!-- FIXME: Need a page to header -->
            <button type="submit" class="btn btn-primary btn-block">Back to dashboard</button>              
        </form>
  </div>
</div>

<?php
    echo file_get_contents ("footer.html");
?>