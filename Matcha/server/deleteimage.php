<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM images");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($results);
$stmt = $db->prepare( "DELETE FROM images WHERE id='$id'");
    try
    {
        foreach($results as $row)
        {
            if ($row['id'] == $id && $_SESSION['username'] == $row['username'])
            {
                $img = $row['name'];
                $usr=$_SESSION['username'];
                unlink("../gallery/".$row['name']);
                $stmt->execute();
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    
    }
    header("Location: ../views/pictures.php");
?>

</body>
</html>