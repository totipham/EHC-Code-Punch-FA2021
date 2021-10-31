<?php

class dbConnect {
    public static function ConnectToDB() {
        $dir = __DIR__;
        return new PDO('sqlite:' . substr($dir, 0, -11) .'/models/database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}
