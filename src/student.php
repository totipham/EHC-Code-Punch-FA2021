<?php

use Student as GlobalStudent;

require_once 'connection.php';

class Student
{
    private $name;
    private $ID;
    private $fullName;
    private $phone;
    private $mail;
    private $password;
    private $role;

    public function __construct($aname, $aID, $fullName, $aPhone, $aMail, $aPassword, $aRole)
    {
        $this->name = $aname;
        $this->ID = $aID;
        $this->fullName=$fullName;
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
    function getFullName(){
        return $this->fullName;
    }
    function setFullName($fullName)
    {
        $this->fullName = $fullName;
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
        $fullName = $this->getFullName();
        $phone = $this->getPhone();
        $mail = $this->getMail();
        $password = $this->getPassword();
        $role = $this->getRole();

        $Insql = "INSERT INTO account(username,id, phone,email,password, role, fullname) VALUE (?,?,?,?,?,?,?);";

        $stsm = $conn->prepare($Insql);
        $stsm->bind_param("", $name, $ID, $phone, $mail, $password, $role, $fullName);

        $res = $stsm->execute();
        dbConnect::Disconnect($conn);
        return $res;
    }

    public static function getInfo()
    {
        $rows = array();

        $conn = dbConnect::ConnectToDB();
        $sql = "SELECT * FROM account;";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $stu = new GlobalStudent($row->username, $row->id, $row->fullname, $row->phone, $row->email, $row->password, $row->role);
                $rows[] = $stu;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    // public function editInfo($stuID)
    // {
    //     $conn = dbConnect::ConnectToDB();
    //     $name = $this->getName();
    //     $ID = $this->getID();
    //     $phone = $this->getPhone();
    //     $mail = $this->getMail();

    //     $sql = "UPDATE student SET (name,studentID,phone,email) VALUE(?,?,?,?) WHERE studentID = $stuID;";
    //     $stsm = $conn->prepare($sql);
    //     $stsm->bind_param("", $name, $ID, $phone, $mail);

    //     $stsm->execute();
    //     dbConnect::Disconnect($conn);
    
    //     // if (!mysqli_query($conn, $sql)) {
    //     //     die('Failed: ' . mysqli_error($conn));
    //     // }
    //     // echo "Done";
    // }
}
