<?php

session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
echo "<div class='row'>";
echo "<div class='col-lg-6'>";
    require_once 'header.php'; 
    require_once "../server/get_images.php";
  //  echo "<div class='col-md-6'> "
  echo "</div>";
  
  echo "<div class='row'>";
echo "<div class='col-lg-6'>";;
    require_once "./profilepic.php";
  echo "</div>";
  
  ?>
  <?php
include_once 'footer.php';
?>