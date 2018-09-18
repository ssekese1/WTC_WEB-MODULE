<?php
// session_start();
 
// If session variable is not set it will redirect to login page
// if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
//   header("location: login.php");
//   exit;
// }
?>
<!DOCTYPE html>
<html>
<head>
        <title></title>
</head>
<body>
<form action="" method="post">
        <!-- <div class="smallcontainer"> -->
        <label class="control-label">Sexual Preference:</label>
        <br />
        <label class="checkbox-inline"> <input type="checkbox" name="sex" value="Homosexual">Homosexual</label>
        <label class="checkbox-inline"><input type="checkbox" name="sex" value="Heterosexual">Heterosexual</label>
        <label class="checkbox-inline"><input type="checkbox" name="sex" value="Bisexual">Bisexual</label>
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
        if(empty($_POST['sex'])) 
        {
                echo "Please select your sexual preference!";
        }
        else
        {
        
                $sex = $_POST['sex'];
                $id = $_SESSION['id'];
                try
                {
                        $stmt = $db->prepare("UPDATE `users` SET Sexual_Preference='$sex' WHERE id = '$id'");
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