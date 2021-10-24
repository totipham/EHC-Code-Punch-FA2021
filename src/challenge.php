<?php
require_once 'controller/cGame.php';
require_once 'controller/checkPermission.php';
require_once 'controller/cPopup.php';
$checkPermission = new checkPermission();

if($checkPermission->isLogin() != 1) {
    header('Location: login');
}

echo file_get_contents('views/header.php');
if (isset($_GET['successful'])):
    if ($_GET['successful'] == 1) {
        $popUp = Popup::oneButton("Upload", "The file has been uploaded!");
    } elseif ($_GET['successful'] == 2) {
        $popUp = Popup::oneButton("Upload", "There was an error uploading this file!");
    }
endif;
if (isset($_GET['correct'])):
    if ($_GET['correct'] == 1) {
        $popUp = Popup::oneButton("Result", "Correct!");
    } elseif ($_GET['correct'] == 0) {
        $popUp = Popup::oneButton("Result", "Incorrect!");
    }
endif;
?>

<header><title>Challenge</title></header>

<?php if ($checkPermission->isTeacher() == 1):?>
<div class="container" style="margin: 50px auto;">
    <div class="row"> 
        <div class="col-md">
            <div class="">
                <form action="controller/upload.php?game=1" method="POST" enctype= "multipart/form-data">
                    <input type="text" name="uploadGame" value="1" hidden>
                    <div class="form-group">
                        <h2 class="text-center">Upload Challenge</h2>  
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="assUpload" required>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Hint</span>
                                </div>
                                <textarea class="form-control" name="hint"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Upload</button> 
                    </div>
                </form>
                <a href="./">
                    <button type="submit" class="btn btn-success btn-block">Back to dashboard</button>              
                </a>
            </div>
        </div>
        <div class="col-md">
            <div class="">
                <div class="form-group"><br>
                    <h2 class="text-center">Student Result</h2>
                    <div class="table-form">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student</th>
                                <th scope="col">Result</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $count = 0;
                            $gameResList = Game::getGameResult();
                            foreach ($gameResList as $gameRes):
                                /* if ($gameRes->getResult() == 1): */
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $count+=1; ?></th>
                                    <td><?php echo $gameRes->getFullname(); ?></td>
                                    <td><?php echo $gameRes->getResult(); ?></td>
                                </tr>
                            <?php 
                                /* endif; */
                            endforeach; 
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<?php /* TODO: Student's Assigment Management */
else:
    $gameList = Game::getGame();
    $hint = $gameList->getHint();
    $flag = $gameList->getGameFile();
?> 
    <div class="upload-form">
        <form action="challenge.php" method="POST">
            <div class="form-group">
                <h2 class="text-center">Answer Challenge</h2>  
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hint</span>
                        </div>
                        <textarea class="form-control" name="hint" placeholder="<?=$hint ?? "Empty"; ?>" disabled></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="gameAns" placeholder="Answer" required="required">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button> 
            </div>
        </form>
        <a href="./">
            <button type="submit" class="btn btn-primary btn-block">Back to Dashboard</button>              
        </a>
    </div>
</div>
<?php 
/* TODO: Check answer */
if (isset($_POST["gameAns"])) {
    $answer = $_POST["gameAns"];
}

if (isset($answer)) {
    if ("uploads/" . $answer === $flag) {
        $result = 1;
       /*  echo "<script>alert('Correct!');</script>"; */
    } else {
        $result = 0;
        /* echo "<script>alert('Incorrect!');</script>"; */
    }
    $regResultRes = Game::regResult($result, $_SESSION['id']);
    header('Location: challenge?correct='.$result);
}
endif;
echo file_get_contents ("views/footer.php");
?>