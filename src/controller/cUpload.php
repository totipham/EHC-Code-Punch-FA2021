<?php

require_once 'connect.php';

class Upload {
    public function __construct() {
        
    }

    public static function uploadAssignment($assName, $target_file) {
        $conn = dbConnect::ConnectToDB();
        if ($sql = $conn -> prepare ("INSERT INTO assignment (assName, assFile) VALUES (?, ?)")) {
            $sql -> bind_param ('ss', $assName, $target_file);
            $res = $sql -> execute();
            $sql -> close();
            return $res;
        } else {
            return 0;
        }
        dbConnect::Disconnect($conn);
    }

    public static function uploadGame($target_file, $hint) {
        $conn = dbConnect::ConnectToDB();
        if ($sql = $conn -> prepare ("REPLACE INTO game (challID, gameFile, hint) VALUES (1, ?, ?)")) {
            $sql -> bind_param ('ss', $target_file, $hint);
            $res = $sql -> execute();
            $sql -> close();
            return $res;
        } else {
            return 0;
        }
        dbConnect::Disconnect($conn);
    }

    public static function assAnswer($assID, $target_file, $id) {
        $conn = dbConnect::ConnectToDB();
        if ($sql = $conn -> prepare ("INSERT INTO answerass (assID, assAnswer, id) VALUES (?, ?, ?)")) {
            $sql -> bind_param ('isi', $assID, $target_file, $id);
            $res = $sql -> execute();
            $sql -> close();
            return $res;
        } else {
            return 0;
        }
        dbConnect::Disconnect($conn);
    }
}
?>