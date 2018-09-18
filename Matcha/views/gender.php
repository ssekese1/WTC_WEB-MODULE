<?php
// session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE>
<html>
<head>
<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
if(isset($_POST['submit']) && $_SESSION['username'])
{ 
//   print_r($_SESSION);
    
    if(empty($_POST['gender'])) 
    {
            echo "Please choose your Gender: Male or Female!";
    }
    else if (($_POST['gender'] == 'Female') && ($_POST['gender'] == 'Male'))
    {
        echo "Please choose your Gender: Male or Female, not both!!!"; 
        
    }
    else
    {
        $id = $_SESSION['id'];
        $gender = $_POST['gender'];
        try
        {
            $stmt = $db->prepare("UPDATE `users` SET Gender='$gender' WHERE id = '$id'");
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
<!-- <div class="small-container"> -->
<form action="#" method="post">
<label class="control-label">Gender:</label>
<div class="checkbox">
<label class="checkbox-inline"><input type="checkbox" name="gender" value="Male">Male</input></label>
<label class="checkbox-inline"><input type="checkbox" name="gender" value="Female">Female</input></label>
<input type="submit" name="submit" value="Submit"/>
</form>
<!-- </div> -->
</body>
</html>