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

        $stmt = $conn->query("SELECT COUNT(*), hint, gameFile FROM game WHERE challID=1");
        $row = $stmt->fetch();
        if ($row > 0) {
            $gameGiven = new GlobalGame($row['gameFile'], $row['hint'], null, null);
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

    public static function isAnswered($id) {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn->prepare('SELECT COUNT(*) FROM gameans WHERE id=?');
        $stmt->execute(array(
            $id
        ));
        $row = $stmt->fetch();
        if ($row['COUNT(*)'] > 0) {
            return true;
        } 

        $conn = null;
        return false;
    }

    public static function removeChall() {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn->prepare('DELETE FROM game WHERE challID=1');
        $res1 = $stmt->execute();

        $stmt = $conn->prepare('DELETE FROM gameans');
        $res2 = $stmt->execute();

        $conn = null;
        return ($res1 && $res2);
    }
}
