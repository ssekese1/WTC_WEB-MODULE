<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

$usr = $_SESSION['username'];
if (isset($_GET['not']) && $_GET['not'] == "on")
    $str = "UPDATE users SET `notification`='Yes' WHERE username='$usr'";
else if (isset($_GET['not']) && $_GET['not'] == "off")
    $str = "UPDATE users SET `notification`='No' WHERE username='$usr'";
try
{
    $db->exec($str);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>