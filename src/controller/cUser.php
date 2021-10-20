<?php use User as GlobalUser;

require_once 'connect.php';

class User {
    private $name;
    private $ID;
    private $fullname;
    private $username;
    private $phone;
    private $mail;
    private $password;
    private $role;


    public function __construct($aName, $aUsername, $aID, $aPhone, $aMail, $aPassword, $aRole) {
        $this->name = $aName;
        $this->ID = $aID;
        $this->username = $aUsername;
        $this->phone = $aPhone;
        $this->mail = $aMail;
        $this->password = md5($aPassword);
        $this->role = $aRole;
    }

    function getName() {
        return $this->name;
    }

    function getUsername() {
        return $this->username;
    }
    
    function setName($aName) {
        $this->name = $aName;
    }
    
    function setUsername() {
        $this->username = $aUsername;
    }

    function getID() {
        return $this->ID;
    }

    function setID($aID) {
        $this->ID = $aID;
    }

    function getPhone() {
        return $this->phone;
    }

    function setPhone($aPhone) {
        $this->phone = (int) $aPhone;
    }

    function getMail() {
        return $this->mail;
    }

    function setMail($aMail) {
        $this->mail = $aMail;
    }

    function setPassword($aPassword) {
        $this->password = md5($aPassword);
    }

    function getPassword() {
        return $this->password;
    }

    function getRole() {
        return $this->role;
    }

    function setRole($aRole) {
        $this->role = $aRole;
    }

    public function addToDB() {
        $conn = dbConnect::ConnectToDB();
        $fullname = $this->getName();
        $username = $this->getUsername();
        $phone = $this->getPhone();
        $email = $this->getMail();
        $password = $this->getPassword();
        $role = $this->getRole();

        $sql = "SELECT * FROM account WHERE username='$username'";
        $old = mysqli_query($conn,$sql);
        if (mysqli_num_rows($old) > 0){
            echo "<script>alert('This username is existed!'); window.location = './register.php';</script>";
            exit;
        }
        if (mysqli_num_rows(mysqli_query($conn, "SELECT email FROM account WHERE email='$email'")) > 0) {
            echo "<script>alert('This email is existed'); window.location = './register.php';</script>";
            exit;
        }

        $stmt = $conn->prepare("INSERT INTO account (username, password, fullname, email, phone, role) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssii", $username, $password, $fullname, $email, $phone, $role);

        $res = $stmt->execute();
        dbConnect::Disconnect($conn);
        return $res;
    }
    /* ($aName, $aUsername, $aPhone, $aMail, $aPassword, $aRole) */

    public static function checkInfo($username, $password) {
        $conn = dbConnect::ConnectToDB();
        if ($stmt = $conn -> prepare ('SELECT id, password, role FROM account WHERE username=?')) {
            $stmt -> bind_param ('s', $_POST['username']);
            $stmt -> execute();
            $stmt -> store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password, $role);
                $stmt->fetch();
                if (md5($_POST['password']) === $password) {
                    /* session_start(); */
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['id'] = $id;
                    $_SESSION['role'] = $role;
                    return 1;
                    /* header("Location: index.php"); */
                } /* else {
                    echo "<script>alert('Incorrect username and/or password!'); window.location = './login.php';</script>";
                } */
            } else {
                return 0;
            }
            dbConnect::Disconnect($conn);
        }
    }

    public static function getInfo() {
        $rows = array();

        $conn = dbConnect::ConnectToDB();
        $sql = "SELECT * FROM account";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_object($result)) {
                $user = new GlobalUser($row->fullname, $row->username, $row->id, $row->phone, $row->email, $row->password, $row->role);
                $rows[] = $user;
            }
        }
        dbConnect::Disconnect($conn);
        return $rows;
    }

    public static function editInfo($userID, $fullname, $phone, $email, $password) {
        $conn = dbConnect::ConnectToDB();

        if ($stmt = $conn->prepare("UPDATE account SET fullname=?, phone=?, email=?, password=? WHERE id=$userID")) {
            $stmt -> bind_param('siss', $fullname, $phone, $email, $password);
            $res = $stmt -> execute();
            return $res;
        } else {
            return 0;
        }
        
        dbConnect::Disconnect($conn);
        
    }

    public static function removeUser($userID) {
        $conn = dbConnect::ConnectToDB();

        $stmt = $conn->prepare('DELETE FROM account WHERE id=? ');
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        dbConnect::Disconnect($conn);
    }
}
?>