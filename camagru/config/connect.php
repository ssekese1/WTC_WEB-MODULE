<?php
include_once("database.php");

session_start(); 

function db_conn($DB_DSN, $DB_USER, $DB_PASSWORD)
{
    try
    {
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return ($db);
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
      return (FALSE);
}
?>