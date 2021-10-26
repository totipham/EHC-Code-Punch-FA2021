<?php
require_once 'controller/cGame.php';
require_once 'controller/checkPermission.php';
require_once 'controller/cPopup.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
}

echo file_get_contents("views/header.php");

if (isset($_GET['successful'])) :
    if ($_GET['successful'] == 1) {
        $popUp = Popup::oneButton("Upload", "The file has been uploaded!");
    } elseif ($_GET['successful'] == 2) {
        $popUp = Popup::oneButton("Upload", "There was an error uploading this file!");
    }
endif;
?>

<header>
    <title>Challenge</title>
</header>

<?php if ($checkPermission->isTeacher() == 1) : ?>
    <div class="container" style="margin: 50px auto;">
        <div class="row">
            <div class="col-md">
                <div class="">
                    <form action="controller/upload.php?game=1" method="POST" enctype="multipart/form-data">
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
                                    foreach ($gameResList as $gameRes) :
                                        /* if ($gameRes->getResult() == 1): */
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $count += 1; ?></th>
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
    else :
        $gameList = Game::getGame();
        $hint = $gameList->getHint();
        $flag = $gameList->getGameFile();
        ?>
            <div class="upload-form">
                <form action="challenge" method="POST">
                    <div class="form-group">
                        <h2 class="text-center">Answer Challenge</h2>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Hint</span>
                                </div>
                                <textarea class="form-control" name="hint" placeholder="<?= $hint ?? "Empty"; ?>" disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="gameAns" placeholder="Answer" required="required">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
                <a href="./">
                    <button type="submit" class="btn btn-success btn-block">Back to Dashboard</button>
                </a>
            </div>
        </div>
    <?php
        /* TODO: Check answer */
        if (isset($_POST["gameAns"]) && isset($hint)) {
            $answer = $_POST["gameAns"];
        }

        if (isset($answer)) {
            if ("uploads/" . $answer === substr($flag, 0, -4)) {
                $result = 1;
                $popUp = Popup::oneButton("Correct!", htmlspecialchars(file_get_contents("uploads/" . $answer), ENT_QUOTES, 'UTF-8'));
            } else {
                $result = 0;
                $popUp = Popup::oneButton("Incorrect!", "<img style='text-align:center;width:465px' src='data:image/jpeg;base64,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'/>");
            }
            $regResultRes = Game::regResult($result, $_SESSION['id']);
        } else if (isset($_POST["gameAns"]) && !isset($hint)) {
            $popUp = Popup::oneButton("Error", htmlspecialchars("There is no challenge here!", ENT_QUOTES, 'UTF-8'));
        }
    endif;
    echo file_get_contents("views/footer.php");
    ?>