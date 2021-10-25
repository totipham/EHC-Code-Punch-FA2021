<?php

class dbConnect {
    public static function ConnectToDB() {
        return new PDO('sqlite:'.__DIR__.'/models/database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}
