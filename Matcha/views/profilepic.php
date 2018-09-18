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

<?php
// require_once "likeprofile.php";
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

//query    
$stmt = $db->prepare 
(
    "SELECT *
     FROM `users` WHERE id = ?"
    );
$stmt->execute([$_SESSION['id']]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
try
{
    if($results)
    {
        foreach($results as $row)
        {
            $id = $_SESSION['id'];//gets userid
            
            $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = '$id'");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($result as $rowImg)
            {
                echo "<div>";
                if(($rowImg['status']) == 0)
                {
                    echo "<img class='ProfilePic' src='../gallery/profile".$id.".jpg'/>";
                }
                else
                {
                    echo "<img class='ProfilePic' src='../img/avatar.png'>";
                }
                echo "<br />";
                echo "<p>".$_SESSION['username']."</p>";
                echo "</div>";

            }
        }
       
    }
    else
    echo "no users registered yet!";

}
catch(PDOException $e)
{
    echo $e->getMessage();
}


if (isset($_SESSION['id']))
{
    if ($_SESSION['id'] == $_SESSION['username'])
    
        echo "you are logged in as".$_SESSION(['username']);
    
    
  echo "<form method='post' action='../server/uploadpic.php' enctype='multipart/form-data'>
  <input type='file' name='file'>
  <button type='submit'  value='Upload' name='submit'>Upload Profile Image!</button>";
}
else
{
    
    echo "You are not logged in!";
}

?>
</div>
</body>
<html>
