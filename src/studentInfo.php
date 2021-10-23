<?php
require_once 'controller/cUser.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}
echo file_get_contents('views/header.html')
?>
<html lang="en">

<body>
    
    <div class="table-form">
    <h2 class="text-center">List of student</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <?php if ($checkPermission->isTeacher() == 1): ?>
                    <th scope="col"></th>
                    <th scope="col"></th>
                <?php endif; ?> 
            </tr>
        </thead>
        <tbody>
            <?php
            $students = User::getInfo();
            $count = 0;
            foreach ($students as $stu):
                if ($stu->getRole() == 0):
            ?>

                <tr>
                    <td><?php echo ++$count ?></td>
                    <td><?php echo $stu->getName() ?></td>
                    <td><?php echo $stu->getPhone() ?></td>
                    <td><?php echo $stu->getMail() ?></td>
                    <?php if ($checkPermission->isTeacher() == 1): ?>
                        <td><a href="profile.php?studentID=<?php echo $stu->getID() ?>">Edit</a></td>
                        <td><a href="controller/remove.php?studentID=<?php echo $stu->getID() ?>">Remove</a></td>
                        <td><a href="controller/add.php">Add</a></td>
                    <?php endif; ?>  
                    
                </tr>
            <?php
                endif;
            endforeach;
            ?>
            
        </tbody>
    </table>
    <a href="./">
        <tr>
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>
        </tr>
    </a>
</div>                
</body>
</html>