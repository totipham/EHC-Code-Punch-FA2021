<?php

use Student as GlobalStudent;

require_once 'controller/connect.php';

class Student
{
    // private $name;
    // private $ID;
    // private $Handin;
    // private $score;
    // private $phone;
    // private $mail;
    // private $password;
    // private $role;

    public function __construct($aname, $aID, $aHandin, $ascore, $aPhone, $aMail, $aPassword, $aRole)
    {
        $this->name = $aname;
        $this->ID = $aID;
        $this->setHandin($aHandin);
        $this->setScore($ascore);
        $this->phone = $aPhone;
        $this->mail = $aMail;
        $this->password = $aPassword;
        $this->role = $aRole;
    }

    // public function display()
    // {
    //     echo "$this->name" . "\t";
    //     echo "$this->ID" . "\t";
    //     echo "$this->Handin" . "\t";
    //     echo "$this->score" . "\t";
    // }

    function getName()
    {
        return $this->name;
    }
    function getID()
    {
        return $this->ID;
    }
    function getHandin()
    {
        return $this->Handin;
    }
    function getScore()
    {
        return $this->score;
    }
    function setName($aName)
    {
        $this->name = $aName;
    }
    function setID($aID)
    {
        $this->ID = $aID;
    }
    function setHandin($aHandin)
    {
        $this->Handin = $aHandin;
    }
    function setScore($ascore)
    {
        // if (is_int($ascore)) {
        $this->score = $ascore;
        // } else {
        //     $this->score = 0;
        // }
    }
    function getPhone()
    {
        return $this->phone;
    }
    function setPhone($aPhone)
    {
        $this->phone = (int) $aPhone;
    }
    function getMail()
    {
        return $this->mail;
    }
    function setMail($aMail)
    {
        $this->mail = $aMail;
    }
    function getPassword()
    {
        return $this->password;
    }
    function setPassword($aPassword)
    {
        $this->password = $aPassword;
    }
    function getRole()
    {
        return $this->role;
    }
    function setRole($aRole)
    {
        $this->role = $aRole;
    }
    public function addToDB()
    {
        $conn = dbConnect::ConnectToDB();
        $name = $this->getName();
        $ID = $this->getID();
        $Handin = $this->getHandin();
        $score = $this->getScore();
        $phone = $this->getPhone();
        $mail = $this->getMail();
        $password = $this->getPassword();
        $role = $this->getRole();

        $sql = "INSERT INTO student(name, studentID, assignment, score, phone,email) VALUE (?,?,?,?,?,?,?,?);";

        $stsm = $conn->prepare($sql);
        $stsm->bind_param("", $name, $ID, $Handin, $score, $phone, $mail, $password, $role);

        $res = $stsm->execute();
        dbConnect::Disconnect($conn);
        return $res;
    }

    public static function getInfo()
    {
        $rows = array();

        $conn = dbConnect::ConnectToDB();
        $sql = "SELECT * FROM `student`;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $stu = new GlobalStudent($row->name, $row->studentID, $row->assignment, 
                $row->score, $row->phone, $row->email, $row->password, $row->isAdmin);
                $rows[] = $stu;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    public function editInfo($stuID)
    {
        $conn = dbConnect::ConnectToDB();
        $name = $this->getName();
        $ID = $this->getID();
        $phone = $this->getPhone();
        $mail = $this->getMail();

        $sql = "UPDATE student SET (name,studentID,phone,email) VALUE(?,?,?,?) WHERE studentID = $stuID;";
        $stsm = $conn->prepare($sql);
        $stsm->bind_param("", $name, $ID, $phone, $mail);

        $stsm->execute();
        dbConnect::Disconnect($conn);
    
        // if (!mysqli_query($conn, $sql)) {
        //     die('Failed: ' . mysqli_error($conn));
        // }
        // echo "Done";
    }
}
