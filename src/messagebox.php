<?php
require_once 'controller/cUser.php';
require_once 'controller/cMessage.php';
require_once 'controller/checkPermission.php';
$checkPermission = new checkPermission();

if ($checkPermission->isLogin() != 1) {
    header('Location: login.php');
}

echo file_get_contents('views/header.php');
?>

<header>
    <title>Chat</title>
</header>
<div style="width: 600px;margin: 40px auto;">
    <div class="container">
        <input type="text" value='<?php echo $_SESSION['id']; ?>' id="fromID" hidden />
        <br>
        <div class="">
            <?php
            if (isset($_GET['toID'])) :
                $userName = User::getInfoFromID($_GET['toID']);
                $fullname = $userName->getName(); ?>
                <input type="text" value=<?php echo $_GET['toID']; ?> id="toID" hidden />
                <h2 class="text-center"><?php echo $fullname; ?></h2>
            <?php
            else :
                header("Location: index");
            endif; ?>
        </div>
        <div class="modal-body" id="msgBody" style="height:300px; background-color:#fff; overflow-y: scroll; overflow-x: hidden;overflow: hidden;">
            <?php
            if (isset($_GET['toID'])) {
                /* $content = mysqli_query($con, "SELECT * FROM message WHERE (fromID='" . $_SESSION['id'] . "' 
                    AND toID = '" . $_GET['toID'] . "') OR (fromID='" . $_GET['toID'] . "' AND toID = '" . $_SESSION['id'] . "')")
                    or die("Failed to query database" . mysqli_error()); */
                $messages = Message::getMessage($_SESSION['id'], $_GET['toID']);
            } else {
                header("Location: message");
            }
            foreach ($messages as $mess) :
                if ($mess->getFromID() == $_SESSION['id']) : ?>
                    <div style='text-align:right;'>
                        <p style='text-align: left;max-width:260px;height:auto;color:#ffff;background-color:#2cb8aa; word-wrap:break-word; display:inline-block;
                                padding:5px; border-radius:10px; max width:70%;'><?php echo htmlspecialchars($mess->getContent(), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>

                <?php else : ?>
                    <div style='text-align:left;'>
                        <p style='text-align: right;max-width:260px;height:auto;background-color:#E0E0E0; word-wrap:break-word; display:inline-block;
                            padding:5px; border-radius:10px; max width:70%;'><?php echo htmlspecialchars($mess->getContent(), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="modal-footer">
            <textarea id="message" class="form-control" style="height:70px;width:438px;"></textarea>
            <button id="send" class="btn btn-success" style="height:70px;">Send</button>
        </div>
    </div>
    <button onclick="location.href='message'" type="submit" class="btn btn-success btn-block">Back to Message</button>
</div>
</body>

<script type="text/javascript">
    var messageBody = document.querySelector('#msgBody');
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

    $(document).ready(function() {
        $("#send").click(function() {
            $.ajax({
                url: "controller/insertMessage.php",
                method: "POST",
                data: {
                    fromID: $("#fromID").val(),
                    toID: $("#toID").val(),
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
                    fromID: $("#fromID").val(),
                    toID: $("#toID").val(),
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