<?php
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}
require_once 'controller/cUser.php';
echo file_get_contents('views/header.php')
?>
<php lang="en">
    <header>
        <title>Message</title>
    </header>
    <body>
        <div class="table-form">
            <h2 class="text-center">Message</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Role</th>
                        <th scope="col" class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $userList = User::getInfo();
                    $count = 0;
                    foreach ($userList as $user) :
                        if ($user->getID() != $_SESSION['id']) :
                    ?>
                            <tr>
                                <td class="text-center"><?= ++$count ?></td>
                                <td class="text-center"><?= $user->getName() ?></td>
                                <td class="text-center"><?= ($user->getRole() == 1) ? "Teacher" : "Student" ?></td>
                                <td class="text-center"><a href="messagebox?toID=<?php echo $user->getID() ?>"><button class="btn btn-outline-success">Message</button></a></td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
            <a href="./">
                <tr>
                    <button type="submit" class="btn btn-success btn-block">Back to Dashboard</button>
                </tr>
            </a>
        </div>
        <?php echo file_get_contents('views/footer.php'); ?>