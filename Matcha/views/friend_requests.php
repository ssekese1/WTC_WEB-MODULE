<?php
//findingSe friend requests
// session_start();

require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$stmt = $db->prepare 
(
    "SELECT *
     FROM `friend_requests` WHERE user_to = ?"
    );
$stmt->execute([$_SESSION['username']]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$errorMsg = "";
if ($results)
{
    foreach($results as $row)
    {
        // $id = $row['id'];
        // $user_to = $row['user_to']; 
        $user_from = $row['user_from'];
        // $status = $row['status'];
        if($row['status'] == 0)
        {
            $email = $_SESSION['email'];
            if ($email !== FALSE)
            {
                $str = sprintf("%s has liked you!\nPlease login to like back or block.", $row['user_from']);
                mail($email, "Matcha Update", $str);
            }
            echo ''. $user_from.' wants to be friends with you!!';
            echo "<form action='#' method='POST'>
            <input type='submit' name='acceptrequest' value='Like Back!'>
            <?php echo $errorMsg; ?>
            <input type='submit' name='blockrequest<?php echo $user_from;?>' value='Block Request'><br />
            <?php echo $errorMsg;?>
            </form>";
        }
    }
            
}
else
{
    echo "you have no friend requests at this time";
}
?>

<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
 if(isset($_POST['acceptrequest']))
 {
    $username = $_SESSION['username'];
    $stmt = $db->prepare("SELECT * FROM `friend_requests` WHERE user_to = '$username' ");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($results);
    if ($results)
    {
        foreach($results as $row)
        {
            $user_from = $row['user_from'];
            $user_to = $_SESSION['username'];
            $stmt = $db->prepare("SELECT email FROM `users` WHERE username = '$user_from'");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($res);
            foreach($res as $roweml)
            {
                $email = $roweml['email'];
                if ($email !== FALSE )
                {
                    $str = sprintf("%s has liked you back!\nPlease login to connect.", $row['user_to']);
                    mail($email, "Matcha Update", $str);
                }
            }
            $stmt = $db->prepare("UPDATE `friend_requests` SET status=1 WHERE user_to='$username';");
            $stmt->execute();
        }
       
        //status of 1 means they liked each other
      
    }
}

if(isset($_POST['blockrequest']))
{
    $stmt = $db->prepare 
    (
        "SELECT *
         FROM `friend_requests`"
        );
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $username = $_SESSION['username'];
    $stmt = $db->prepare("UPDATE `friend_requests` SET status = '2' WHERE user_to='$username'");
    $stmt->execute();
}
   //status of 2 means they liked each other
?>

