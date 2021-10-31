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
        <title>Chat</title>
    </header>
    <body>
        <div class="table-form">
            <h2 class="text-center">Chat</h2><br>
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
                                <td class="text-center"><?= htmlspecialchars($user->getName(), ENT_QUOTES, 'UTF-8') ?></td>
                                <td class="text-center"><?= ($user->getRole() == 1) ? "Teacher" : "Student" ?></td>
                                <td class="text-center"><a href="chatbox?toID=<?php echo $user->getID() ?>"><button class="btn btn-outline-success">Chat</button></a></td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <?php echo file_get_contents('views/footer.php'); ?>