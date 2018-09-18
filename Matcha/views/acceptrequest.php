<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$username = $_SESSION['username'];
// print_r($_SESSION);
 if(isset($_POST['acceptrequest']))
 {
    $stmt = $db->prepare 
    (
        "SELECT *
         FROM `friend_requests` WHERE user_to = ?"
        );
    $stmt->execute([$_SESSION['username']]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($results);
    print_r($results); 
    // $errorMsg = "";
   
       
    //         // {
    //         $stmt = $db->prepare("UPDATE users SET friend_array = '$user_from' WHERE username = '$user_to'");
    //         $stmt->execute();

    //         $stmt = $db->prepare("UPDATE users SET friend_array = '$user_to' WHERE username = '$user_from'");
    //         $stmt->execute();

    //         $stmt = $db->prepare("DELETE * FROM friend_array WHERE user_to = ?");
    //         $stmt->execute([$_SESSION['username']]);

    //         $errorMsg = "you are now friends with $user_from!";    

    //         // }
    //     }
    // // echo $friend_array_count;
    // }

    //friend array for frien request reciever
    // $stmt = $db->prepare("SELECT friend_array FROM `users` WHERE username='$user_to'");
    // $stmt->execute();
    // $resultsfriend = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($results);
    // foreach($resultsfriend as $rowfriend)
    // // {
    // $resultfriend = $rowfriend['friend_array'];
    // $results_explode_friend = explode(",", $resultfriend);
    // $friend_count = count($results_explode_friend);
    // }
    
    // if ($row['friend_array'] == "")
    // {
    //     $friend_array_count = count(NULL);
    //     // echo $friend_array_count;
    // $friend_array = explode(',',$_POST['friend_array']);
    // $interests = implode(',',$_POST['check_list']);


    //     $stmt = $db->prepare("UPDATE users SET friend_array = $user_from WHERE username = '$username'");
    //       $friend_array = explode(',',$_row['friend_array']);
    //     $stmt->execute($friend_array);
    // // }
    // }
    // if ($rowfriend['friend_array']== "")
    // {
    //     $friend_count = count(NULL);
    //     // echo $friend_count;
        
    // }

    // if ($friend_array_count == NULL)
    // {
    //     // echo $friend_array_count;
        
    //     $stmt = $db->prepare("UPDATE users SET friend_array = CONCAT(friend_array, '$user_from') WHERE username = '$username'");
    //     $stmt->execute();
        
    // }
    // if ($friend_count == NULL)
    // // {
    //     $stmt = $db->prepare("UPDATE users SET friend_array = EXPLODE(friend_array, '$user_to') WHERE username = '$user_from'");
    //     $stmt->execute();
        
    // }
    // $stmt = $db->prepare("DELETE * FROM friend_array WHERE user_to='$username'");
    // $stmt->execute();
    // $errorMsg = "you are now friends with $user_from!";
    
 }


?>
<form action="acceptrequest.php" method="POST">
<input type="submit" name="acceptrequest<?php// echo $user_from;?>" value="Like Back!"><Lbr />
<?php //echo $errorMsg; ?>
<input type="submit" name="blockrequest<?php echo $user_from;?>" value="Block Request"><br />
<?php //echo $errorMsg;?>
</form>