<?php
require_once 'controller/cAssignment.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}

echo file_get_contents ('views/header.html');
?>

<header><title>View Assignment</title></header>
<div class="table-form">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Assignment</th>
            <th scope="col">Student</th>
            <th scope="col">Answer</th>
            </tr>
        </thead>
        <tbody>
<?php
    $assAnsList = Assignment::getAssAns();
    $count = 0;
    foreach ($assAnsList as $assAns): 
?>
        <tr>
            <th scope="row"><?php echo $count+=1; ?></th>
            <td><?php echo $assAns->getAssName(); ?></td>
            <td><?php echo $assAns->getFullname(); ?></td>
            <td>
                <a href="<?php echo '../' . $assAns->getAssAnswer(); ?>">View Assignment</a>
            </td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container">
  <div class="vertical-center">
        <form action="index.php">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </form>
  </div>
</div>
<?php
echo file_get_contents ('views/footer.html'); 
?>