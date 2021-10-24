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
        $fullname_fetch->execute(array(
            $id
        ));
        $fullname = ($fullname_fetch->fetchObject())->fullname;
        return $fullname;
        $conn = null;
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
        $result = $conn->query($sql);

        if ($result->columnCount() > 0) {
            while ($row = $result->fetchObject()) {
                /* $assName = GlobalAssignment::fetchAssName($row->assID); */
                $fullname = GlobalGame::fetchFullname($row->id);
                $gameAns = new GlobalGame(null, null, $fullname, $row->result);
                $rows[] = $gameAns;
            }
        }
        $conn = null;
        return $rows;
    }

    public static function getGame() {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn->query("SELECT hint, gameFile FROM game WHERE challID=1");

        if ($stmt->columnCount() > 0) {
            $row = $stmt->fetchObject();
            $gameGiven = new GlobalGame($row->gameFile, $row->hint, null, null);
        }
        $conn = null;
        return $gameGiven;
    }

    public static function regResult($result, $id) {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn -> prepare ("REPLACE INTO gameans (id, result) VALUES (?, ?)");
        $res = $stmt->execute(array(
            $id,
            $result
        ));
        return $res;

        $conn = null;
    }
}
?>