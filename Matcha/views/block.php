
<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
{
    // $user_to = $_GET['user_to'];
    // $user_from =$_GET['user_from'];
    
   $stmt = $db->prepare 
   (
       "SELECT *
        FROM `friend_requests`"
       );
   $stmt->execute();
   $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   print_r($results);
   print_r($results); 
   $username = $_SESSION['username'];
   $stmt = $db->prepare("UPDATE `friend_requests` SET status = '2' WHERE user_to='$username' OR user_from = '$username'");
   $stmt->execute();
   echo "User blocked successfully";
   //status of 2 means they liked each other

    }

?>