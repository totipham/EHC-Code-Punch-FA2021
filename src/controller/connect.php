<?php

class dbConnect {
    public static function ConnectToDB() {
        $dir = __DIR__;
        return new PDO('sqlite:https://dashboard.heroku.com/models/database.db');
    }

    public static function Disconnect($con) {
        return null;
    }
}
