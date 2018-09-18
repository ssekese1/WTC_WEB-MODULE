<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_SESSION['id'];
$stmt = $db->prepare("UPDATE `users` SET online_status='0' WHERE id = '$id'");
$stmt->execute();
session_unset();
session_destroy();
header("Location: ../index.php");
?>
