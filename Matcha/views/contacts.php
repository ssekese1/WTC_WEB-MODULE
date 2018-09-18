<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

include_once "friend_requests.php";
require_once 'header.php';  
// require_once "../views/geolocation.php";

?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php

// require_once "likeprofile.php";
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

//query   
$username = $_SESSION['username']; 
$stmt = $db->prepare 
(
    "SELECT * FROM `friend_requests` where status = '1'"
    );
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

try
{
    if($results)
    {
                $stmt = $db->prepare("SELECT * FROM profileimg");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($results as $data)
                {
                    foreach($result as $row)
                    {
                        if (strcmp($data['user_from'], $row['username']) == 0 && strcmp($data['user_to'], $_SESSION['username']) == 0 || strcmp($data['user_to'], $row['username']) == 0 && strcmp($data['user_from'], $_SESSION['username']) == 0)
                        {
                            $id = $row['userid'];
                        
                            $usr = $row['username'];
                            echo "<div>";
                            if(($row['status']) == 0)
                            {
                                echo "<img class='ProfilePic' src='../gallery/profile".$id.".jpg'/>";
                                echo "<br />";
                                echo "<p>".$usr."</p>";
                                echo "<button><a href='chat.php?usr=$usr'/>Chat!</button>";
                                echo "<button><a href='block.php?usr=$usr'/>unlike!</button>";
                            }
                            else
                            {
                                echo "<img class='ProfilePic' src='../img/avatar.png'>";
                                echo "<br />";
                                echo "<p>".$usr."</p>";
                                echo "<button><a href='chat.php?usr=$usr'/>Chat!</button>";
                                echo "<button><a href='block.php?usr=$usr'/>unlike!</button>";
                            }
                            // echo "<p>".$usr."</p>";

                        }
                    }
                
                    echo "</div>";
                }
        }
        else
        {
            echo "You do not have friends as of yet!";
        }

}
catch(PDOException $e)
{
    echo $e->getMessage();
}

?>

<?php
include_once 'footer.php';
?>
</body>
</html>