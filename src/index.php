<!DOCTYPE html>
<html>
    <header>
        <title>Homepage</title>
    </header>
    <body>
        <div class="form">
            <form action="authentication.php" method="POST">
                <label>
                    Username:
                    <input type="text" name="username">
                </label><br>
                <label>
                    Password:
                    <input type="password" name="password">
                </label><br>
                <input type="submit" class="btn" value="Login">
            </form>
            <form action="register.php">
                <input type="submit" class="btn" value="Register">
            </form>
        </div>
    </body>
</html>