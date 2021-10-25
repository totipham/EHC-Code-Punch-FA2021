<?php

class dbConnect {
//     public static function ConnectToDB() {
//         $server='localhost';
//         $usernameDB='root';
//         $passwordDB='';
//         $nameDB='users';
//         return mysqli_connect($server, $usernameDB, $passwordDB, $nameDB);
//     }

//     public static function Disconnect($con) {
//         mysqli_close($con);
//     }
// }

$host = "ec2-34-225-66-116.compute-1.amazonaws.com";
$user = "pwzvmqrhquhguy";
$password = "09fb5ccea9f0e8a2d0d540c2adec50f18246e7a35e433def7d407f18f7b88f72";
$dbname = "dflrrlif83qbdm";
$port = "5432";

try{
  //Set DSN data source name
    $dsn = "pgsql:host=" . $host . ";port=" . $port .";dbname=" . $dbname . ";user=" . $user . ";password=" . $password . ";";


  //create a pdo instance
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
echo 'Connection failed: ' . $e->getMessage();
}
}
?>
