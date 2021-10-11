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