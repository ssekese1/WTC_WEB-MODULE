<?php
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

if (isset($_GET['to']) && isset($_GET['msg']) && $_SESSION['username'])
{
    $sql = sprintf("INSERT INTO posts(`msg`, `user_to`, `user_from`) VALUES ('%s', '%s', '%s')", $_GET['msg'], $_SESSION['username'], $_GET['to']);
    $stmt =$db->prepare($sql);
        try
        {
            $stmt->execute();

        }
        catch(PDOException $e)
        {
        echo $e->getMessage();
        }
}
else if (isset($_GET['to']) && $_SESSION['username'])
{
    $sql = "SELECT * FROM posts";
    try{
        foreach($db->query($sql) as $row)
        {
            if (strcmp($row['user_to'], $_GET['to']) == 0 && strcmp($row['user_from'], $_SESSION['username']) == 0)
                echo $row['user_to'].": ".$row['msg']."<br/>";
            if (strcmp($row['user_to'], $_SESSION['username']) == 0 && strcmp($row['user_from'], $_GET['to']) == 0)
                echo $row['user_to'].": ".$row['msg']."<br/>";
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}