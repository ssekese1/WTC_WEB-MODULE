<?php
session_start();
require_once '../config/connect.php';

function validate_user($conn, $usr, $pswd)
{
    $_SESSION = FALSE;
    $pswd = hash('whirlpool', $pswd);

    $stmt = $conn->prepare("SELECT * FROM users");
    $results = $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    try
    {
        foreach($results as $row)
        {
            $id = $row['id'];
            if ($row['username'] == $usr && $row['passwd'] == $pswd)
            {
            // echo $id;
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['passwd'] = $row['passwd'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['not'] = $row['notification'];
                $stmt =$conn->prepare("UPDATE `users` SET online_status='1' WHERE id = '$id'");//1 means online
                $stmt->execute();
                return (TRUE);
            }
            else
            echo "usename doesnot exist!";
        }
    }
    catch(PDOException $e)
    {
        echo "Sign_in failed:<br/>".$e->getMessage();
    }
    $_SESSION['err']['sign_in'] = "Username/password incorrect";
    return (FALSE);
}

$conn = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
if (isset($_POST['username']) && isset($_POST['pswd']) && $_POST['login_user'] == "ok")
{
    $var = validate_user($conn, $_POST['username'], $_POST['pswd']);
    if ($var === TRUE)
    {
        header("location: ../views/profile.php?id=$id");
        return (TRUE);
    }
}
header("Location: ../views/login.php");
?>