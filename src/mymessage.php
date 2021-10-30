<?php
require_once 'controller/cUser.php';
require_once 'controller/checkPermission.php';
require_once 'controller/cPopup.php';
require_once 'controller/cMessage.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}
echo file_get_contents('views/header.php');
?>
<html lang="en">
<header>
    <title>My Message</title>
</header>

<body>
    <div class="table-form" style="width: 700px;">
        <h2 class="text-center">My Message</h2><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $students = User::getInfo();
                $count = 0;
                $toIDList = Message::fetchUser($_SESSION['id']);
                foreach ($students as $stu):
                    if (in_array($stu->getID(), $toIDList)):
                ?>
                        <tr>
                            <td class="text-center"><?php echo ++$count ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($stu->getName(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><a href="message?fromID=<?= $stu->getID() ?>"><button class="btn btn-outline-success">View Message</button></a></td>
                            <?php if ($checkPermission->isTeacher() == 1) : ?>
                                <td class="text-center"><a href="profile?studentID=<?php echo $stu->getID() ?>"><button class="btn btn-outline-success">Edit</button></a></td>
                                <td class="text-center"><a href="controller/remove?studentID=<?php echo $stu->getID(); ?>"><button class="btn btn-outline-danger">Remove</button></a></td>
                            <?php endif; ?>
                        </tr>
                <?php
                    endif;
                endforeach;
                ?>

            </tbody>
        </table>

    </div>
    <?php echo file_get_contents('views/footer.php'); ?>