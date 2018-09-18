<!DOCTYPE html>
<html>
<head>
<title></title>
</head>
<body>
<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_GET['id'];
$sql2 = "SELECT * FROM images";
$sql = "DELETE FROM images WHERE id='$id'";
    try
    {
        foreach($db->query($sql2) as $row)
        {
            if ($row['id'] == $id && $_SESSION['username'] == $row['username'])
            {
                $img = $row['name'];
                $usr = $_SESSION['username'];
                unlink("../gallery/".$row['name']);
                $db->exec($sql);
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    
    }
    header("Location : ../server/get_images.php");
?>

</body>
</html>