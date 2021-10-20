<?php use Game as GlobalGame;

require_once 'connect.php';

class Game {
    private $gameFile;
    private $hint;
    private $id;
    private $result;


    public function __construct($gameFile, $hint, $fullname, $result) {
        $this->gameFile = $gameFile;
        $this->hint = $hint;
        $this->fullname = $fullname;
        $this->result = $result;
    }

    public function getGameFile() {
        return $this->gameFile;
    }

    public function getHint() {
        return $this->hint;
    }

    public function getFullname() {
        return $this->fullname;
    }

    public function getResult() {
        return $this->result;
    }

    public static function fetchFullname($id) {
        $conn = dbConnect::ConnectToDB();
        $fullname_fetch = $conn -> prepare("SELECT fullname FROM account WHERE id=?");
        $fullname_fetch -> bind_param ('i', $id);
        $fullname_fetch -> execute();
        $fullname_fetch -> store_result();
        $fullname_fetch->bind_result($fullname);
        $fullname_fetch->fetch();
        return $fullname;
        dbConnect::Disconnect($conn);
    }

    /* public static function fetchAssName($assID) {
        $conn = dbConnect::ConnectToDB();
        $assName_fetch = $conn -> prepare("SELECT assName FROM assignment WHERE assID=?");
        $assName_fetch -> bind_param ('i', $assID);
        $assName_fetch -> execute();
        $assName_fetch -> store_result();
        $assName_fetch->bind_result($assName);
        $assName_fetch->fetch();
        return $assName;
        dbConnect::Disconnect($conn);
    } */

    public static function getGameResult() {
        $conn = dbConnect::ConnectToDB();

        $rows = array();

        $sql = "SELECT id, result FROM gameans";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                /* $assName = GlobalAssignment::fetchAssName($row->assID); */
                $fullname = GlobalGame::fetchFullname($row->id);
                $gameAns = new GlobalGame(null, null, $fullname, $row->result);
                $rows[] = $gameAns;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    public static function getGame() {
        $conn = dbConnect::ConnectToDB();

        $sql = "SELECT hint, gameFile FROM game WHERE challID=1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_object($result);
            $gameGiven = new GlobalGame($row->gameFile, $row->hint, null, null);
        }
        dbConnect::Disconnect($conn);
        return $gameGiven;
    }

    public static function regResult($result, $id) {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn -> prepare ("REPLACE INTO gameans (id, result) VALUES (?, ?)");
        $stmt -> bind_param ('ii', $id, $result);
        $res = $stmt -> execute();
        return $res;

        dbConnect::Disconnect($conn);
    }
}
?>