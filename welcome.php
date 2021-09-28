<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header ('Location: index.php'); //if user hasn't log in -> redirect to index.php 
    exit;
}
?>
<!DOCTYPE html>
<html>
    <header>
        <title>Welcome Page</title>       
    </header>
    <body>
        <h1>Welcome, <?=$_SESSION['username']?></h1>
    </body>
</html>