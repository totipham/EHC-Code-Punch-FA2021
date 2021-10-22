<?php

class dbConnect {
    public static function ConnectToDB() {
        /* $server='localhost';
        $usernameDB='root';
        $passwordDB='';
        $nameDB='users';
        return mysqli_connect($server, $usernameDB, $passwordDB, $nameDB); */
        return new PDO('sqlite:'.__DIR__.'\models\database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}

?>