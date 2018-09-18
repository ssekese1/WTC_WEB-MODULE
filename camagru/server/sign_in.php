<?php
require_once '../config/connect.php';
session_start();
function validate_user($conn, $usr, $pswd)
{
    $_SESSION = FALSE;
    $pswd = hash('whirlpool', $pswd);
    $sql = "SELECT * FROM users";
    try
    {
        foreach($conn->query($sql) as $row)
        {
            if ($row['username'] == $usr && $row['passwd'] == $pswd)
            {
                $_SESSION['username'] = $row['username'];
                $_SESSION['passwd'] = $row['passwd'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['not'] = $row['notification'];
                return (TRUE);
            }
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
if ($conn === FALSE)
    return (FALSE);
if (isset($_POST['username']) && isset($_POST['pswd']) && $_POST['login_user'] == "ok")
{
    $var = validate_user($conn, $_POST['username'], $_POST['pswd']);
    if ($var === TRUE)
    {
        header("location: ../views/welcome.php");
        return (TRUE);
    }
}
header("Location: ../views/login.php");
?>