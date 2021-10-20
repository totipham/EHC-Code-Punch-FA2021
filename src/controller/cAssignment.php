<?php use Assignment as GlobalAssignment;

require_once 'connect.php';

class Assignment {
    private $assID;
    private $assName;
    private $assAnswer;
    private $assFile;
    private $fullname;


    public function __construct($assID, $assName, $assAnswer, $assFile, $fullname) {
        $this->assID = $assID;
        $this->assName = $assName;
        $this->assAnswer = $assAnswer;
        $this->assFile = $assFile;
        $this->fullname = $fullname;
    }

    public function getAssID() {
        return $this->assID;
    }

    public function getAssName() {
        return $this->assName;
    }

    public function getAssAnswer() {
        return $this->assAnswer;
    }

    public function getAssFile() {
        return $this->assFile;
    }

    public function getFullname() {
        return $this->fullname;
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

    public static function fetchAssName($assID) {
        $conn = dbConnect::ConnectToDB();
        $assName_fetch = $conn -> prepare("SELECT assName FROM assignment WHERE assID=?");
        $assName_fetch -> bind_param ('i', $assID);
        $assName_fetch -> execute();
        $assName_fetch -> store_result();
        $assName_fetch->bind_result($assName);
        $assName_fetch->fetch();
        return $assName;
        dbConnect::Disconnect($conn);
    }

    public static function getAssAns() {
        $conn = dbConnect::ConnectToDB();

        $rows = array();

        $sql = "SELECT * FROM answerass";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $assName = GlobalAssignment::fetchAssName($row->assID);
                $fullname = GlobalAssignment::fetchFullname($row->id);
                $assAns = new GlobalAssignment(null, $assName, $row->assAnswer, null, $fullname);
                $rows[] = $assAns;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    public static function getAssignment() {
        $conn = dbConnect::ConnectToDB();

        $rows = array();

        $sql = "SELECT * FROM assignment";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $assGiven = new GlobalAssignment($row->assID, $row->assName, null, $row->assFile, null);
                $rows[] = $assGiven;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }
}
?>