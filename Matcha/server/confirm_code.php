<?php
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function verify_user($db, $usr, $code)
{
    $_SESSION = FALSE; 
    if (!preg_match("/^[0-9a-zA-Z_]{5,8}$/", $_POST['username']))
    {
        $_SESSION['err']['username'] = "Username must be 5 - 8 characters and contain only digits, letters and underscore!";
        return (FALSE);
    }
    $code = hash('whirlpool', $code);
    $stmt = $db->prepare("SELECT * FROM `temp_users`");
    $results = $stmt->execute();
    $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
    // print_r($results);
    try
    {
        foreach($results as $row)
        {
            if ($usr == $row['username'] && $code == $row['confirm_code'])
            {
                $fname = $row['Firstname'];
                $lname = $row['Lastname'];
                $bday = $row['DOB'];
                $email = $row['email'];
                $pswd = $row['passwd'];
                $stmt = $db->prepare("INSERT INTO users(Firstname, Lastname, username, DOB, email, `passwd`,online_status, confirm_code) VALUES ('$fname', '$lname','$usr','$bday', '$email', '$pswd','0', 'Verified')");
                $results = $stmt->execute();
                $stmt = $db->prepare("DELETE FROM temp_users WHERE username='$usr'");
                $result = $stmt->execute();
                return (TRUE);
                //status of 0 means offline
            }
        }
    }
    catch(PDOException $e)
    {
        echo "Confirmation code failed:<br>".$e->getMessage();
    }
    return (FALSE);
}


if (isset($_POST['username']) && isset($_POST['code']))
{
    $var = verify_user($db, $_POST['username'], $_POST['code']);
    if ($var === TRUE)
    {
       $username = $_POST['username'];
        $stmt = $db->prepare("SELECT * FROM `users` WHERE username = '$username'");
        $result = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);

        try
        {
                    $userid = $result[0]['id'];
                    $username = $result[0]['username'];
                     $stmt = $db->prepare("INSERT INTO `profileimg` (`userid`, `status`, `username`)
                    VALUES ('$userid', '1', '$username')");
                    $result = $stmt->execute();
            
        }
        catch(PDOException $e)
        {
            echo "profile picture upload failed:<br>".$e->getMessage();
            return (FALSE);
        }
        header("Location: ../views/login.php");
    }
    else
    {
        $_SESSION['err']['code'] = "Incorrect username/confirmation code provided";
        header("Location: ../views/confirm_code.php");
    }
}
?>