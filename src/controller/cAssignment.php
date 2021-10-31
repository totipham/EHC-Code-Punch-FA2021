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
        $fullname_fetch->execute(array(
            $id
        ));
        $fullname = ($fullname_fetch->fetchObject())->fullname;

        return $fullname;
        dbConnect::Disconnect($conn);
    }

    public static function fetchAssName($assID) {
        $conn = dbConnect::ConnectToDB();
        $assName_fetch = $conn -> prepare("SELECT assName FROM assignment WHERE assID=?");
        $assName_fetch->execute(array(
            $assID
        ));
        $assName = ($assName_fetch->fetchObject())->assName;
        return $assName;
        dbConnect::Disconnect($conn);
    }

    public static function fetchAssFile($assID) {
        $conn = dbConnect::ConnectToDB();
        $assFile_fetch = $conn -> prepare("SELECT assFile FROM assignment WHERE assID=?");
        $assFile_fetch->execute(array(
            $assID
        ));
        $assFile = ($assFile_fetch->fetchObject())->assFile;
        $conn = null;
        return $assFile;
    }

    public static function fetchAssAnsFile($assID) {
        $conn = dbConnect::ConnectToDB();
        $assAnsFile_fetch = $conn -> prepare("SELECT assAnswer FROM answerass WHERE assID=?");
        $assAnsFile_fetch->execute(array(
            $assID
        ));
        $assAnsFile = ($assAnsFile_fetch->fetchObject())->assAnswer;
        $conn = null;
        return $assAnsFile;
    }

    public static function getAssAns() {
        $conn = dbConnect::ConnectToDB();

        $rows = array();

        $sql = "SELECT * FROM answerass";
        $result = $conn->query($sql);

        if ($result->columnCount() > 0) {
            while ($row = $result->fetchObject()) {
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
        $stmt = $conn->query($sql);

        if ($stmt->columnCount() > 0) {
            while ($row = $stmt->fetchObject()) {
                $assGiven = new GlobalAssignment($row->assID, $row->assName, null, $row->assFile, null);
                $rows[] = $assGiven;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    public static function removeAss($assID) {
        $conn = dbConnect::ConnectToDB();
        $stmt1 = $conn->prepare('DELETE FROM assignment WHERE assID=?');
        $res1 = $stmt1->execute(array(
            $assID
        ));

        $stmt2 = $conn->prepare('DELETE FROM answerass WHERE assID=?');
        $res2 = $stmt2->execute(array(
            $assID
        ));

        $conn = null;
        return ($res1 && $res2);
    }
}
