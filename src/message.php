<?php
require_once 'controller/cUser.php';
require_once 'controller/cMessage.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) :
    $userName = User::getInfoFromID($_GET['id']);
    if (!is_null($userName)) :
        $fullname = htmlspecialchars($userName->getName(), ENT_QUOTES, 'UTF-8');
    else :
        header('Location: student');
        exit;
    endif;
elseif (isset($_GET['fromID']) && !is_null($_GET['fromID'])) :
    $userName = User::getInfoFromID($_GET['fromID']);
    if (!is_null($userName)) :
        $fullname = htmlspecialchars($userName->getName(), ENT_QUOTES, 'UTF-8');
    else :
        header('Location: mymessage');
        exit;
    endif;
else :
    header('Location: student');
    exit;
endif;
echo file_get_contents("views/header.php");
?>
<header>
    <title>Message</title>
</header>
<div style="width: 600px;margin: 40px auto;">
    <div class="container">
        <br>
        <div class="">
            <?php
            if (isset($fullname)) : ?>
                <h2 class="text-center"><?= $fullname ?></h2><br>
            <?php endif; ?>
        </div>
        <div class="modal-body" id="msgBody" style="height:auto; background-color:#fff; overflow-y: scroll; overflow-x: hidden; overflow: hidden;">
            <?php
            if (isset($_GET['id'])) {
                $messages = Message::getMessage($_SESSION['id'], $_GET['id']);
                if (!is_null($messages)) :
                    if ($messages->getFromID() == $_SESSION['id']) : ?>
                        <div style='text-align:center;'>
                            <p style='text-align: left;max-width:500px;height:auto;color:#12160b;background-color:#efef91; word-wrap:break-word; display:inline-block;
                                        padding:5px; max width:70%;'><?php echo htmlspecialchars(html_entity_decode($messages->getContent()), ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                    <?php endif;
                endif;
            } else if (isset($_GET['fromID'])) {
                $messages = Message::getMessage($_GET['fromID'], $_SESSION['id']);
                if (!is_null($messages)) :
                    if ($messages->getToID() == $_SESSION['id']) : ?>
                        <div style='text-align:center;'>
                            <p style='text-align: left;max-width:500px;height:auto;color:#12160b;background-color:#e0e0e0; word-wrap:break-word; display:inline-block;
                                        padding:5px; max width:70%;'><?php echo htmlspecialchars(html_entity_decode($messages->getContent()), ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
            <?php endif;
                endif;
            } else {
                header("Location: message");
                exit;
            } ?>
        </div>
        <?php if (isset($_GET['id']) && !is_null($_GET['id'])) : ?>
            <div class="modal-footer">
                <button id="remove" class="btn btn-danger" style="height:70px;">Remove</button>
                <textarea id="message" class="form-control" style="height:70px;width:300px;"></textarea>
                <button id="update" class="btn btn-success" style="height:70px;">Update</button>
            </div>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['id'])): ?>
        <button onclick="location.href='student'" type="submit" class="btn btn-success btn-block">Back to List</button>
    <?php elseif (isset($_GET['fromID'])): ?>
        <button onclick="location.href='mymessage   '" type="submit" class="btn btn-success btn-block">Back to My Message</button>
    <?php endif; ?>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $("#update").click(function() {
            $.ajax({
                url: "controller/insertMessage.php",
                method: "POST",
                data: {
                    toID: '<?= $_GET['id'] ?>',
                    message: $("#message").val()
                },
                dataType: "text",
                success: function(data) {
                    window.location.reload(false);
                }
            });
        });
        $("#remove").click(function() {
            $.ajax({
                url: "controller/removeMessage.php",
                method: "POST",
                data: {
                    toID: '<?= $_GET['id'] ?>'
                },
                dataType: "text",
                success: function(data) {
                    window.location.reload(false);
                }
            });
        });
    });
</script>
<?php echo file_get_contents('views/footer.php'); ?>