<?php
require_once 'controller/cUser.php';
require_once 'controller/checkPermission.php';
require_once 'controller/cPopup.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}

if ($checkPermission->isTeacher() == 1) {
    $id = $_GET["studentID"] ?? $_SESSION["id"];
} else {
    $id = $_SESSION["id"];
}

$userInfo = User::getInfoFromID($id);
if (!is_null($userInfo)) {
    $username = $userInfo->getUsername();
    $fullname = $userInfo->getName();
    $email = $userInfo->getMail();
    $phone = $userInfo->getPhone();
    $role = $userInfo->getRole();
} else {
    header('Location: ./');
    exit;
}
if ($username != $_SESSION['name'] && $role != 0) {
    echo "<script>alert('You are not allowed to do this!'); window.location = './';</script>";
    exit;
}

echo file_get_contents('views/header.php');

if (isset($_GET['successful'])) :
    if ($_GET['successful'] == 1) {
        Popup::oneButton("Profile", "Update information successfully!");
    } elseif ($_GET['successful'] == 2) {
        Popup::oneButton("Profile", "You are not allowed to do this!");
    } elseif ($_GET['successful'] == 0) {
        Popup::oneButton("Profile", "Update information not successfully!");
    } elseif ($_GET['successful'] == 3) {
        Popup::oneButton("Profile", "Passwords are not matching!");
    }
endif;
?>

<header>
    <title>Profile</title>
</header>
<div style="width: 340px;margin: 30px auto;">
    <form class="form" action="controller/edit.php?studentID=<?=$id?>" method="POST">
        <h2 class="text-center"><?=htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . " 's Profile"?></h2>
        <p style="text-align: center;">Edit these fields to update information!</p>
        <?php if ($checkPermission->isTeacher() == 1) : ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" value="<?=htmlspecialchars($username)?>" disabled>
            </div>
            <div class="form-group">
                <input type="text" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" class="form-control" name="fullname" value="<?=htmlspecialchars($fullname)?>">
            </div>
            <input type="text" class="form-control" name="studentID" value="<?=$id?>" hidden>
        <?php endif; ?>
        <div class="form-group">
            <input type="email" pattern="^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$" class="form-control" name="email" value="<?=htmlspecialchars($email)?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" pattern="[0-9]{3,10}" title="A good phone number will be contained 9-11 digits" class="form-control" name="phone" value="<?=htmlspecialchars($phone)?>" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="password" pattern="^w+\@w+\.w+$" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again">
        </div>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?? '' ?>">
        <button type="submit" class="btn btn-success btn-block" id="updateButton">Update Information</button>
    </form>
</div>
<?php echo file_get_contents('views/footer.php'); ?>