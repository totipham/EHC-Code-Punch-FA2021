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
    <div class="inner">
        <header>
            <span style="color:red;" id="tagline"><?php echo "<h1><b>Welcome " . $_SESSION['name'] . "</h1></b>"; ?></span>
        </header>
    </div>

    <div class="inner">
        <div id="content-wrapper">
            <aside class="sidebar">
                <nav>
                    <ul>
                        <li>
                            <a href="studentInfo.php">View student list</a>
                        </li>
                        <li>
                            <a class="active" href="controller/info.php?studentID=<?php echo $_SESSION['ID']; ?>">View info</a>
                        </li>
                        <li>
                            <a href="assignmentManager.php">Check Assignment</a>
                        </li>
                    </ul>
                </nav>
            </aside>


            <!-- <form class="" action="studentInfo.php" method="POST">
                <button type="submit" name="button">View student list</button>
            </form>

            <form class="" action="controller/info.php?studentID=<?php echo $_SESSION['ID']; ?>" method="post">
                <button type="submit" name="button">View info</button>
            </form>

            <form class="" action="assignmentManager.php" method="POST">
                <button type="submit" name="button">Check Assignment</button>
            </form> -->

            <form class="" action="logout.php" method="POST">
                <button type="submit" name="button">Log out</button>
            </form>
        </div>
    </div>
</body>
<?php include('./template/footer.php') ?>

</html>