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
        $this->password = $aPassword;
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

        /* $sql = "SELECT * FROM account WHERE username='$username'";
        $old = mysqli_query($conn,$sql); */

        $sql = "SELECT * FROM account WHERE username=?";
        $checkUsername = $conn->prepare($sql);
        $checkUsername->execute(array(
            $username
        ));

        /* if (mysqli_num_rows($old) > 0){
            echo "<script>alert('This username is existed!'); window.location = './register.php';</script>";
            exit;
        } */

        if ($checkUsername->fetchColumn() > 0){
            echo "<script>alert('This username is existed!'); window.location = '../register.php';</script>";
            return 0;
        }

        if (($conn->query("SELECT email FROM account WHERE email='$email'")->fetchColumn()) > 0) {
            echo "<script>alert('This email is existed'); window.location = '../register.php';</script>";
            return 0;
        }

        $stmt = $conn->prepare("INSERT INTO account (username, password, fullname, email, phone, role) VALUES (?,?,?,?,?,?)");
        /* $stmt->bind_param("ssssii", $username, $password, $fullname, $email, $phone, $role); */
        $res = $stmt->execute(array(
            $username,
            md5($password),
            $fullname,
            $email,
            $phone,
            $role
        ));
        $conn = null;
        return $res;
    }
    /* ($aName, $aUsername, $aPhone, $aMail, $aPassword, $aRole) */

    public static function checkInfo($username, $password) {
        $conn = dbConnect::ConnectToDB();
        if ($stmt = $conn -> prepare ('SELECT COUNT(*), id, password, role FROM account WHERE username=?')) {
            $res = $stmt->execute(array(
                $username
            ));
            $row = $stmt->fetch();
            /* $stmt -> store_result(); */
            if ($row > 0) {
                /* $stmt->bind_result($id, $password, $role); */
                /* $row = $stmt->fetch(); */
                if (md5($password) === $row['password']) {
                    /* session_start(); */
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $username;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $conn = null;
                    return 1;
                    /* header("Location: index.php"); */
                } /* else {
                    echo "<script>alert('Incorrect username and/or password!'); window.location = './login.php';</script>";
                } */
            } else {
                $conn = null;
                return 0;
            }
            
        }
    }

    public static function getInfo() {
        $conn = dbConnect::ConnectToDB();
        $rows = array();

        $sql = "SELECT * FROM account";
        /* $result = mysqli_query($conn, $sql); */
        $result = $conn->query($sql);

        if ($result->columnCount() > 0) {
            /* while ($row = mysqli_fetch_object($result)) {
                $user = new GlobalUser($row->fullname, $row->username, $row->id, $row->phone, $row->email, $row->password, $row->role);
                $rows[] = $user;
            } */
            while ($row = $result->fetchObject()) {
                $user = new GlobalUser($row->fullname, $row->username, $row->id, $row->phone, $row->email, $row->password, $row->role);
                $rows[] = $user;
            }
        }
        $conn = null;
        return $rows;
    }

    public static function getInfoFromID($id) {
        $conn = dbConnect::ConnectToDB();
        $sql = "SELECT * FROM account WHERE id=?";
        $stmt = $conn->prepare($sql);
        $res = $stmt->execute(array(
            $id
        ));
        
        if ($stmt->columnCount() > 0) {

            /* $row = $stmt->fetch(); */

            /* $row = mysqli_fetch_object($result); */
            $row = $stmt->fetchObject();
            $user = new GlobalUser($row->fullname, $row->username, $row->id, $row->phone, $row->email, $row->password, $row->role);
        }
        $conn = null;
        return $user;
    }

    public static function editInfo($userID, $fullname, $phone, $email, $password) {
        $conn = dbConnect::ConnectToDB();

        if ($stmt = $conn->prepare("UPDATE account SET fullname=?, phone=?, email=?, password=? WHERE id=?")) {
            $res = $stmt->execute(array(
                $fullname,
                $phone,
                $email,
                $password,
                $userID
            ));
            return $res;
        } else {
            return 0;
        }
        
        $conn = null;
        
    }

    public static function removeUser($userID) {
        $conn = dbConnect::ConnectToDB();

        $stmt1 = $conn->prepare('DELETE FROM account WHERE id=?');
        $res1 = $stmt1->execute(array(
            $userID
        ));
        $stmt2 = $conn->prepare('DELETE FROM gameans WHERE id=?');
        $res2 = $stmt2->execute(array(
            $userID
        ));
        $stmt3 = $conn->prepare('DELETE FROM answerass WHERE id=?');
        $res3 = $stmt3->execute(array(
            $userID
        ));
        $stmt4 = $conn->prepare('DELETE FROM message WHERE toID=? OR fromID=?');
        $res4 = $stmt4->execute(array(
            $userID
        ));
        $conn = null;
        return ($res1 ||$res2 ||$res3 ||$res4);
    }
}
?>