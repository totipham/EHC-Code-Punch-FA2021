<?php

require_once 'connect.php';
$conn = dbConnect::ConnectToDB();
$username = 'hs';
$password = '0123';
        $stmt = $conn->prepare ("SELECT id, password, role FROM account WHERE username=?");
        $stmt->execute(array(
            $username
        ));
        /* $stmt->bindParam(':username', $username);
        $stmt->execute(); */
        /* $stmt -> store_result(); */
        if ($stmt->columnCount() > 0) {
            /* $stmt->bind_result($id, $password, $role); */
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $row['password'] ?? 'Blank';
            if (md5($password) == $row['password']) {
                /* session_start(); */
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $username;
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $conn = null;
                echo $row['id'], $row['password'];
                /* header("Location: index.php"); */
            } /* else {
                echo "<script>alert('Incorrect username and/or password!'); window.location = './login.php';</script>";
            } */
        } else {
            echo "Error";
        }
            
