<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
</head>
<body>
    <h3>Register</h3>
    <form action="register_check.php" method="POST">
        <table>
            <tr>
                <td>Username: </td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Repassword: </td>
                <td><input type="password" name="repassword"></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Full Name: </td>
                <td><input type="text" name="fullname"></td>
            </tr>
            <tr>
                <td>Phone: </td>
                <td><input type="text" name="phone"></td>
            </tr>
            <tr>
                <td>Role: </td>
                <td><select name="role">
                    <option value=""></option>
                    <option value="Teacher">Teacher</option>
                    <option value="Student">Student</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name ="submit">Register</button>
                    <button type="reset">Reset </button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
