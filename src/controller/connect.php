<?php

class dbConnect {
    public static function ConnectToDB() {
        /* $server='localhost';
        $usernameDB='root';
        $passwordDB='';
        $nameDB='users';
        return mysqli_connect($server, $usernameDB, $passwordDB, $nameDB); */
        $cur_dir = substr(__DIR__, 0, -10);
        return new PDO('sqlite:'.$cur_dir.'models\database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}

?>