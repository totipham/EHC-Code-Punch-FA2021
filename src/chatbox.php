<?php
require_once 'controller/cUser.php';
require_once 'controller/cChat.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login');
    exit;
}

if (isset($_GET['toID']) && !empty($_GET['toID'])) :
    $userName = User::getInfoFromID($_GET['toID']);
    if (!is_null($userName)) :
        $fullname = htmlspecialchars($userName->getName(), ENT_QUOTES, 'UTF-8'); ?>

    <?php else :
        header('Location: index');
        exit;
    endif; ?>
<?php
else :
    header('Location: index');
    exit;
endif;

echo file_get_contents("views/header.php");
?>

<header>
    <title>Chat</title>
</header>
<div style="width: 600px;margin: 40px auto;">
    <div class="container">
        <br>
        <div class="">
            <?php
            if (isset($fullname)) : ?>
                <h2 class="text-center"><?= $fullname ?></h2>
            <?php endif; ?>
        </div>
        <div class="modal-body" id="msgBody" style="height:300px; background-color:#fff; overflow-y: scroll; overflow-x: hidden;">
            <?php
            if (isset($_GET['toID'])) {
                $messages = Chat::getMessage($_SESSION['id'], $_GET['toID']);
            } else {
                header("Location: chat");
            }
            foreach ($messages as $mess) :
                if ($mess->getFromID() == $_SESSION['id']) : ?>
                    <div style='text-align:right;'>
                        <p style='text-align: left;max-width:260px;height:auto;color:#ffff;background-color:#2cb8aa; word-wrap:break-word; display:inline-block;
                                padding:5px; border-radius:10px; max width:70%;'><?php echo htmlspecialchars(html_entity_decode($mess->getContent()), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php else : ?>
                    <div style='text-align:left;'>
                        <p style='text-align: right;max-width:260px;height:auto;background-color:#E0E0E0; word-wrap:break-word; display:inline-block;
                            padding:5px; border-radius:10px; max width:70%;'><?php echo htmlspecialchars(html_entity_decode($mess->getContent()), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="modal-footer">
                <div class="row" style="width:570px;">
                    <div class="col-10">
                        <textarea id="message" class="form-control" style="height:70px;width:440px"></textarea>
                    </div>
                    <div class="col">
                        <button id="send" class="btn btn-success" style="height:70px;width:80px;">Update</button>
                    </div>
                </div>
            </div>
    </div>
    <button onclick="location.href='chat'" type="submit" class="btn btn-success btn-block">Back to Chat</button>
</div>
</body>
<script type="text/javascript">
    var messageBody = document.querySelector('#msgBody');
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    $(document).ready(function() {
        $("#send").click(function() {
            $.ajax({
                url: "controller/insertChat.php",
                method: "POST",
                data: {
                    toID: "<?=$_GET['toID']?>",
                    message: $("#message").val()
                },
                dataType: "text",
                success: function(data) {
                    $("#message").val("");
                }
            });
            messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
        });

        setInterval(function() {
            $.ajax({
                url: "controller/realtimeChat.php",
                method: "POST",
                data: {
                    toID: "<?=$_GET['toID']?>"
                },
                dataType: "text",
                success: function(data) {
                    $("#msgBody").html(data);
                }
            });
        }, 700);
    });
</script>
<?php echo file_get_contents('views/footer.php'); ?>