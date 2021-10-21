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
    
    function setFromID() {
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

        $sql = "INSERT INTO message (toID, fromID, content) VALUES ('$toID', '$fromID', '$content')";
        $res = "";
        if ($conn->query($sql)) {
            $res = "";
        } else {
            $res = "Error. Please try again!";
        }

        dbConnect::Disconnect($conn);
        return $res;
    }

    public static function getMessage($fromID, $toID) {
        $rows = array();

        $conn = dbConnect::ConnectToDB();
        $result = mysqli_query($conn, "SELECT * FROM message WHERE (fromID='" . $fromID . "' 
        AND toID = '" . $toID . "') OR (fromID='" . $toID . "' AND toID = '" . $fromID . "')");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $message = new GlobalMessage($row->messID, $row->fromID, $row->toID, $row->content);
                $rows[] = $message;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }
}
?>