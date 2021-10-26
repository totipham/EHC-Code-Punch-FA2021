<?php use Message as GlobalMessage;

require_once 'connect.php';

class Message {
    private $fromID;
    private $toID;
    private $content;
    
    public function __construct($messID, $fromID, $toID, $content) {
        $this->messID = $messID;
        $this->fromID = $fromID;
        $this->toID = $toID;
        $this->content = $content;
    }

    function getMessID() {
        return $this->messID;
    }

    function getFromID() {
        return $this->fromID;
    }
    
    function setMessID($messID) {
        $this->messID = $messID;
    }
    
    function setFromID($fromID) {
        $this->fromID = $fromID;
    }

    function getToID() {
        return $this->toID;
    }

    function setToID($toID) {
        $this->toID = $toID;
    }

    function getContent() {
        return $this->content;
    }

    function setContent($content) {
        $this->content = $content;
    }

    public static function insertToDB ($fromID, $toID, $content) {
        $conn = dbConnect::ConnectToDB();

        /* $fromID = $this->getFromID();
        $toID = $this->getToID();
        $content = $this->getContent(); */

        $res = "";
        if ($conn->query("INSERT INTO message (toID, fromID, content) VALUES ('$toID', '$fromID', '$content')")) {
            $res = "";
        } else {
            $res = "Error. Please try again!";
        }

        $conn = null;
        return $res;
    }

    public static function getMessage($fromID, $toID) {
        $rows = array();

        $conn = dbConnect::ConnectToDB();
        $result = $conn->query("SELECT * FROM message WHERE (fromID='" . $fromID . "' 
        AND toID = '" . $toID . "') OR (fromID='" . $toID . "' AND toID = '" . $fromID . "')");

        if ($result->columnCount() > 0) {
            while ($row = $result->fetchObject()) {
                $message = new GlobalMessage($row->messID, $row->fromID, $row->toID, $row->content);
                $rows[] = $message;
            }
        }
        $conn = null;
        return $rows;
    }
} ?>
