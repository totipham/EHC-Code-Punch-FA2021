<?php
require_once 'controller/cUser.php';
require_once 'controller/checkPermission.php';
require_once 'controller/cPopup.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login');
}
echo file_get_contents('views/header.php');

if (isset($_GET['successful'])) {
    if ($_GET['successful'] == 1) {
        $popUp = Popup::oneButton("Student List", "Remove student successfully");
    } elseif ($_GET['successful'] == 2) {
        $popUp = Popup::oneButton("Student List", "Remove student not successfully");
    }
}
if (isset($_GET['addstatus'])) {
    if ($_GET['addstatus'] == 1) {
        $popUp = Popup::oneButton("Add Student", "Add student successfully!");
    } elseif ($_GET['addstatus'] == 2) {
        $popUp = Popup::oneButton("Add Student", "Add student not successfully!");
    } elseif ($_GET['addstatus'] == 3) {
        $popUp = Popup::oneButton("Add Student", "Passwords are not matching!");
    }
}
?>
<html lang="en">
<header><title>Student List</title></header>
<body>
    
    <div class="table-form">
    <h2 class="text-center">List of student</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Phone</th>
                <th scope="col" class="text-center">Email</th>
                <?php if ($checkPermission->isTeacher() == 1): ?>
                    <th scope="col"></th>
                    <th class="text-center">
                        <a href="controller/add">
                            <button class="btn btn-outline-primary">Add</button>
                        </a>
                    </th>
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
                    <td class="text-center"><?php echo ++$count ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($stu->getName(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($stu->getPhone(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($stu->getMail(), ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php if ($checkPermission->isTeacher() == 1): ?>
                        <td class="text-center"><a href="profile?studentID=<?php echo $stu->getID() ?>"><button class="btn btn-outline-primary">Edit</button></a></td>
                        <td class="text-center"><a href="controller/remove?studentID=<?php echo $stu->getID();?>"><button class="btn btn-outline-danger">Remove</button></a></td>
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
<?php echo file_get_contents ('views/footer.php'); ?>