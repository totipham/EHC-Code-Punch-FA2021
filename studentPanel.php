<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
}

?>


<html>
<?php include('./template/header.php') ?>

<br />

<body>
    <span style="color:deeppink" id="tagline"><?php echo "<h1><b>Welcome " . $_SESSION['name'] . "</h1></b>"; ?></span>
    <aside class="sidebar">
        <nav>
            <ul>
                <li>
                    <a class="active" href="controller/info.php?studentID=<?php echo $_SESSION['ID']; ?>">View info</a>
                </li>
                <li>
                    <a href="assignmentManager.php">Check Assignment</a>
                </li>
            </ul>
        </nav>
    </aside>
    <!-- <form class="" action="controller/info.php?studentID=<?php echo $_SESSION['ID']; ?>" method="post">
        <button type="submit" name="button">View info</button>
    </form>

    <form class="" action="assignmentManager.php" method="POST">
        <button type="submit" name="button">Check Assignment</button>
    </form> -->

    <form class="" action="logout.php" method="POST">
        <button type="submit" name="button">Log out</button>
    </form>
</body>
<?php include('./template/footer.php') ?>

</html>