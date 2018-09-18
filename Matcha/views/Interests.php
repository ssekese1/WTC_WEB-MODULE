<?php
// session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
        <title>Edit Your Profile</title>
</head>
<body>
<form action="" method="post">
<!-- <div class="small-container" -->
        <label class="control-label">Interests:</label>
        <div class="checkbox">
        <label class="checkbox-inline"> <input type="checkbox" name="check_list[]" value="#vegan">#vegan</label>
        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Gymnastics">#Gym</label>
        <!-- <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Bungee jumping">#Bungee jumping</label> -->
        <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Kart Racing">#Kart Racing</label>
        <!-- <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Ice Skating">#Ice Skating</label> -->
        <!-- <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Mountain Biking">#Mountain Biking</label> -->
        <!-- <label class="checkbox-inline"><input type="checkbox" name="check_list[]" value="#Skiing">#Skiing</label> -->
        <input type="submit" name="submit" Value="Submit"/>
        <!-- </div> -->
</form>
</body>
</html>

<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
if(isset($_POST['submit']))
{       
        if(empty($_POST['check_list'])) 
        {
                echo "Please select atleast one interest!";
        }
        else
        {
        
                $interests = implode(',',$_POST['check_list']);
                $id = $_SESSION['id'];
                try
                {
                        $stmt = $db->prepare("UPDATE `users` SET Interests='$interests' WHERE id = '$id'");
                        $results = $stmt->execute();
                        echo "Update Successful";
                }
                catch (PDOException $e)
                {
                echo "Failed: <br/>".$e->getMessage();
                }
        }
}
        
?>