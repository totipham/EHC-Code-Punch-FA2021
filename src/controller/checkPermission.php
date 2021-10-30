<?php
require_once 'connect.php';

class checkPermission {
    public function __construct() {
        session_start();
    }

    public function isLogin() {
        $conn = dbConnect::ConnectToDB();
        $stmt = $conn->prepare('SELECT COUNT(*) as username FROM account WHERE id = ?');
        $stmt->execute(array(
            $_SESSION['id']
        ));

        $row = $stmt->fetchAll()[0]['username'];
        if (isset($_SESSION['loggedin']) && ($row == 1)) {
            return 1;
        }
        return 0;
    }

    public function isTeacher() {
        if (isset($_SESSION["role"]) && $_SESSION["role"] == 1) {
            return 1;
        }
        return 0;
    }
}
