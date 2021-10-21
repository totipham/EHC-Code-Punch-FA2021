<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}
require_once 'controller/cUser.php';
echo file_get_contents('views/header.html')
?>
<html lang="en">

<body>
    
    <div class="table-form">
    <h2 class="text-center">List of student</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $userList = User::getInfo();
            $count = 0;
            foreach ($userList as $user):
                if ($user->getID() != $_SESSION['id']):
            ?>

                <tr>
                    <td><?php echo ++$count ?></td>
                    <td><?php echo $user->getName() ?></td>
                    <td><?php echo $user->getRole() ?></td>
                    <td><a href="messagebox.php?toID=<?php echo $user->getID() ?>">Message</a></td>
                    
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
