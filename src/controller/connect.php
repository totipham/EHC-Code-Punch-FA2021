<?php

class dbConnect {
    public static function ConnectToDB() {
        $server='localhost';
        $usernameDB='root';
        $passwordDB='';
        $nameDB='users';
        return mysqli_connect($server, $usernameDB, $passwordDB, $nameDB);
    }

    public static function Disconnect($con) {
        mysqli_close($con);
    }
}

?>