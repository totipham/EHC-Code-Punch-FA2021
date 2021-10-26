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

/* $query = "SELECT * FROM account WHERE id=$id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_object($result); */
$userInfo = User::getInfoFromID($id);
if (!is_null($userInfo)) {
    $username = $userInfo->getUsername();
    $fullname = $userInfo->getName();
    $email = $userInfo->getMail();
    $phone = $userInfo->getPhone();
    $role = $userInfo->getRole();
} else {
    header('Location: index');
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
        $popUp = Popup::oneButton("Profile", "Passwords are not matching!");
    }
endif;
?>

<header>
    <title>Profile</title>
</header>
<div style="width: 340px;margin: 30px auto;">
    <form class="form" action="controller/edit.php?studentID=<?php echo $id; ?>" method="POST">
        <h2 class="text-center"><?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'). " 's Profile"; ?></h2>
        <p style="text-align: center;">Edit these fields to update information!</p>
        <?php if ($checkPermission->isTeacher() == 1) : ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" value="<?= $username ?>" disabled>
            </div>
            <div class="form-group">
                <input type="text" pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" class="form-control" name="fullname" value="<?= $fullname ?>">
            </div>
            <input type="text" class="form-control" name="studentID" value="<?= $id ?>" hidden>
        <?php endif; ?>
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="text" pattern="[0-9]{3,10}" title="A good phone number will be contained 9-11 digits" class="form-control" name="phone" value="<?= $phone ?>" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="password" pattern="^w+\@w+\.w+$" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repassword" placeholder="Enter Password Again">
        </div>
        <button type="submit" class="btn btn-success btn-block" id="updateButton">Update Information</button>
    </form>
    <a href=<?= (isset($_GET['studentID'])) ? "./student" : "./" ?>>
        <button type="submit" class="btn btn-success btn-block"><?= (isset($_GET['studentID'])) ? "Back to Student" : "Back to Dashboard" ?></button>
    </a>
</div>
<?php echo file_get_contents('views/footer.php'); ?>