<?php
require_once 'controller/cAssignment.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}

echo file_get_contents ('views/header.php');
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
            <td><?php echo htmlspecialchars($assAns->getAssName(), ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($assAns->getFullname(), ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="<?php echo  $assAns->getAssAnswer(); ?>" target="_blank" rel="noopener noreferrer">View Assignment</a>
            </td>
        </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="container">
  <div class="vertical-center">
        <form action="assignment.php">
            <button type="submit" class="btn btn-success btn-block">Back to Assignment</button>              
        </form>
  </div>
</div>
<?php
echo file_get_contents ('views/footer.php'); 
?>