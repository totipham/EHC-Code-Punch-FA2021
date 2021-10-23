<?php
/* require_once 'controller/connection.php'; */
require_once 'controller/checkPermission.php';
require_once 'controller/cAssignment.php';

$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}

echo file_get_contents('views/header.html');
?>
<header><title>Assignment</title></header>
<?php if ($checkPermission->isTeacher() == 1): ?>
 <!-- TODO: Teacher's Assignment Management -->
<div class="row"> 
    <div class="col-md">
        <div class="upload-form">
            <form class="form" action="controller/upload.php" method="POST" enctype= "multipart/form-data">
                <div class="form-group">
                    <h2 class="text-center">Upload Assignment</h2>  
                    <input type="text" name="uploadAssignment" value="1" hidden>
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
            <div class="form">
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
</div>
<?php
else:
    $assGiven = Assignment::getAssignment();
?>
<div class="upload-form">
    <div class="form">
        <form action="controller/upload.php" method="POST" enctype= "multipart/form-data">
            <div class="form-group">
                <h2 class="text-center">Answer</h2>
                <div class="form-group">
                    <select class="form-control" name="assName" required>
                        <?php foreach ($assGiven as $ass): ?>
                            <option value='<?php echo $ass->getAssID(); ?>'><?php echo $ass->getAssName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="file" class="form-control-file" name="assUpload" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Upload</button> 
            </div>
        </form>
        <a href="view_assignment.php">
        <button type="submit" class="btn btn-primary btn-block">View Assignment</button>
        </a>
    </div>
</div>
<?php endif; ?>

<div class="container">
  <div class="vertical-center">
        <form action="./">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
  </div>
</div>

<?php echo file_get_contents ("views/footer.html"); ?>