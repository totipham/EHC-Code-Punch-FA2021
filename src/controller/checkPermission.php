<?php
class checkPermission {
    public function __construct() {
        session_start();
    }

    public function isLogin() {
        if (isset($_SESSION['loggedin'])) {
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
?>