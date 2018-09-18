<?php
// Initialize the session
session_start();
 
//If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

require_once 'header.php';  
?>
 
<!DOCTYPE html>
<html>
<head></head>
<body>

<?php
//query    
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

$id = $_GET['id'];
$stmt = $db->prepare 
(
    "SELECT *
     FROM `users` WHERE id='$id'"
    );
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($results);
try
{
    if($results)
    {
        foreach($results as $rowstatus)
        {
            if ($rowstatus['online_status'] == 1)
            {
                echo "online";
            }
            else
            {
                $last = $rowstatus ['created'];
                echo "offline";
                echo"<br />";
                echo "last seen $last";
            }
        }
            $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid=$id");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
                foreach($result as $row)
                {
                     $id = $row['userid'];
                    echo "<div>";
                    if(($row['status']) == 0)
                    {
                        echo "<img class='ProfilePic' src='../gallery/profile".$id.".jpg'/>";
                    }
                    else
                    {
                        echo "<img class='ProfilePic' src='../img/avatar.png'>";
                    }
                    echo"<br />";
                echo "</div>";
                }
                        foreach($results as $row)
                        
                        {
                            ?>
                            <table>
                            <tr><td>Username:</td><td><?php echo $row['username'];?></td></tr>
                            <tr><td>Firstname:</td><td><?php echo $row['Firstname'];?></td></tr>
                            <tr><td>Lastname:</td><td><?php echo $row['Lastname'];?></td></tr>
                            <tr><td>Gender:</td><td><?php echo $row['Gender'];?></td></tr>
                            <tr><td>Date Of Birth:</td><td><?php echo $row['DOB'];?></td></tr>
                            <tr><td>Interests:</td><td><?php echo $row['Interests'];?></td></tr>
                            <tr><td>Sexual Preference:</td><td><?php echo $row['Sexual_Preference'];?></td></tr>
                            <tr><td>Biography:</td><td><?php echo $row['Biography'];?></td></tr>
                            
                            </table>
                            <?php
                            $username=$row['username'];    
                            $stmt = $db->prepare 
                            (
                                "SELECT *
                                FROM `images` WHERE username='$username'"
                            );
                            $stmt->execute();
                            $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                            foreach($results as $rowimag)
                            {
                                echo '<img id="pics" src="../gallery/'.$rowimag['name'].'"/>';
                            }
                        }
                    }
    }
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_GET['id'];
$stmt = $db->prepare 
(
    "SELECT *
     FROM `users` WHERE username='$username'"
    );
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$errorMsg = "";
if(isset($_POST['addfriend']))
{
    $friend_request = $_POST['addfriend'];
    $user_to = $username;
    $user_from = $_SESSION['username'];
    if (strcmp($user_to,$user_from) == 0)
    {
        $errorMsg = "you cannot like yourself! <br />";
    }
    else
    {
        $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = ?");
        $stmt->execute([$_SESSION['id']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $rowImage)
        {
            if($rowImage['status'] == 1)
            {
            echo "please upload profile image to perform this request!";
            }
            else
            {
                $stmt = $db->prepare 
                (
                    "SELECT *
                    FROM `friend_requests` WHERE user_to='$username' AND user_from = '$user_from'"
                    );
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // print_r($username);
                // print_r($user_from);
                
                if ($results)
                {
                    foreach ($results as $row)
                    {
                        if ($row['status'] == 0)
                        $errorMsg = "you already liked $user_to";
                        if($row['status'] == 1)
                        $errorMsg = "you already have $user_to in your contacts";
                        if ($row['status'] == 2)
                        $errorMsg = "you cannot like $user_to, $user_to blocked  you!";
                    }
                }
                else
                {

                $stmt = $db->prepare("INSERT INTO friend_requests(user_from,user_to,status) VALUES('$user_from','$user_to','0')");
                $stmt->execute();
                $errorMsg = "A message has been sent to $user_to!!<br />";
                //a status of 0 means pending request/like
                }
            }
        }
    }
}
?>
</div>
<form action=" #" method="post">
<input type="submit" name="addfriend" value="Like" />
<?php echo $errorMsg; ?>
<!-- <input type="submit" name="sendmsg" value="Send Message!!" /> -->
<?php
include_once 'footer.php';
?>
</form>
</body>
<html>