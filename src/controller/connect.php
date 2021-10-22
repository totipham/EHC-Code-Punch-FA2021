<?php

class dbConnect {
    public static function ConnectToDB() {
        /* $server='localhost';
        $usernameDB='root';
        $passwordDB='';
        $nameDB='users';
        return mysqli_connect($server, $usernameDB, $passwordDB, $nameDB); */
        $cur_dir = getcwd();
        return new PDO('sqlite:../models/database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}

?>