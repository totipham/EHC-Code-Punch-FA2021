<?php
session_start();
require_once 'controller/cUser.php';
require_once 'controller/cMessage.php';

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

echo file_get_contents ('views/header.html');
?>

<header><title>Chat</title></header>
<div class="upload-form">
    <div class="form">
        <input type="text" value='<?php echo $_SESSION['id']; ?>' id="fromID" hidden/>
        <div class="">
            <?php
                if (isset($_GET['toID'])):
                    /* $userName = mysqli_query($con, "SELECT * FROM account WHERE id='" . $_GET['toID'] . "'")
                    or die ("Failed to query database" . mysqli_error()); */

                    $userName = User::getInfoFromID($_GET['toID']);

                    $fullname = $userName->getName(); ?>
                    <input type="text" value=<?php echo $_GET['toID']; ?> id="toID" hidden/>
                    <h2 class="text-center"><?php echo $fullname; ?></h2>
                <?php
                else:
                    /* $userName = mysqli_query($con, "SELECT * FROM account")
                    or die ("Failed to query database" . mysqli_error());

                    $uName = mysqli_fetch_assoc($userName);
                    $_SESSION['toID'] = $uName['id']; ?>
                    <input type="text" value=<?php echo $_SESSION['toID']; ?> id="toID" hidden/>
                    <h2 class="text-center"><?php echo $uName['fullname']; ?></h2> */
                    header("Location: index.php");
                endif; ?>
        </div> 
        <div class="modal-body" id="msgBody" style="height:300px; background-color:#fff; overflow-y: scroll; overflow-x: hidden;">
            <?php
                if (isset($_GET['toID'])) {
                    /* $content = mysqli_query($con, "SELECT * FROM message WHERE (fromID='" . $_SESSION['id'] . "' 
                    AND toID = '" . $_GET['toID'] . "') OR (fromID='" . $_GET['toID'] . "' AND toID = '" . $_SESSION['id'] . "')")
                    or die("Failed to query database" . mysqli_error()); */
                    $messages = Message::getMessage($_SESSION['id'], $_GET['toID']);
                } else {
                    /* $content = mysqli_query($con, "SELECT * FROM message WHERE (fromID='" . $_SESSION['id'] . "' 
                    AND toID = '" . $_SESSION['toID'] . "') OR (fromID='" . $_SESSION['toID'] . "' AND toID = '" . $_SESSION['id'] . "')")
                    or die("Failed to query database" . mysqli_error()); */
                }

                /* while ($message = mysqli_fetch_assoc($content)): */
                foreach ($messages as $mess):
                    if ($mess->getFromID() == $_SESSION['id']): ?>
                            <div style='text-align:right;'>
                                <p style='text-align: left;max-width:260px;height:auto;color:#ffff;background-color:#004C99; word-wrap:break-word; display:inline-block;
                                padding:5px; border-radius:10px; max width:70%;'><?php echo $mess->getContent(); ?></p>
                            </div>
                            
                    <?php else: ?>
                            <div style='text-align:left;'>
                                <p style='text-align: right;max-width:260px;height:auto;background-color:#E0E0E0; word-wrap:break-word; display:inline-block;
                            padding:5px; border-radius:10px; max width:70%;'><?php echo $mess->getContent(); ?></p>
                            </div>
                    <?php endif; ?>
                <?php endforeach; ?>
        </div>  
        <div class="modal-footer">
            <textarea id="message" class="form-control" style="height:70px;width:438px;"></textarea>
            <button id="send" class="btn btn-primary" style="height:70px;">Send</button>
        </div>
    </div>
    <button onclick="location.href='message.php'" type="submit" class="btn btn-primary btn-block">Back to Message</button>
</div>
</body>

<script type="text/javascript">
/* Scroll to the bottom of messageBody */
var messageBody = document.querySelector('#msgBody');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;


$(document).ready(function() {
    $("#send").click(function(){
        $.ajax({
            url:"controller/insertMessage.php",
            method:"POST",
            data:{
                fromID: $("#fromID").val(),
                toID: $("#toID").val(),
                message: $("#message").val()
            },
            dataType:"text",
            success:function(data) {
                $("#message").val("");
            }
        });
    });

    setInterval(function(){
        $.ajax({
            url:"controller/realtimeChat.php",
            method:"POST",
            data:{
                fromID: $("#fromID").val(),
                toID: $("#toID").val(),
            },
            dataType:"text",
            success:function(data) {
                $("#msgBody").html(data);
            }
        });
    }, 700);
});
</script>
</html>