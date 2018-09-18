<?php
session_start();

require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function verify_user($db, $usr, $code, $pswd, $repswd)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z].{1,8}+$^", $usr))
    $_SESSION['err']['username'] = "Username must be 8 characters!";
    if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $pswd))
        $_SESSION['err']['pswd'] = "Password must have One Uppercase letter, a number and no less than than 8 characters!";
    if ($repswd != $pswd)
        $_SESSION['err']['re-pswd'] = "The two passwords do not match";
    if (isset($_SESSION['err']))
        return (FALSE);
    $code = hash('whirlpool', $code);
    $pswd = hash('whirlpool', $pswd);
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $results = $stmt->FetchAll(PDO::FETCH_ASSOC);

    try
    {
        foreach($results as $row)
        {
            print_r($row);
            if ($usr == $row['username'] && $code == $row['confirm_code'])
            {
                $stmt = $db->prepare("UPDATE users SET passwd='$pswd' WHERE username='$usr'");
                $stmt->exec();
                return (TRUE);
            }
        }
    }
    catch(PDOException $e)
    {
        echo "Password reset failed:<br>".$e->getMessages();
    }
    return (FALSE);
}
function change_password($db, $pswd, $new)
{
    if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $pswd))
        $_SESSION['err']['pswd'] = "Password must have One Uppercase letter, a number and no less than than 8 characters!";
    if (isset($_SESSION['err']))
        return (FALSE);
    $pswd = hash('whirlpool', $pswd);
    $new = hash('whirlpool', $new);
    $usr = $_SESSION['username'];
    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row)
    {
        if ($row['username'] == $usr && $_SESSION['passwd'] == $row['passwd'])
        {
            if ($_SESSION['passwd'] == $pswd)
            {
                try
                {
                    $stmt = $db->prepare("UPDATE users SET `passwd`='$new' WHERE username='$usr'");
                    $stmt->execute();
                    $_SESSION['passwd'] = $new;
                    echo "Success";
                }
                catch(PDOException $e)
                {
                    echo "Failed</br>".$e->getMessage();
                }
            }
            else
                echo "Failed: Incorrect password entered.";
        }
    }
}
if (isset($_POST['username']) && isset($_POST['code']))
{
    $var = verify_user($db, $_POST['username'], $_POST['code'], $_POST['pswd'], $_POST['re-pswd']);
    if ($var === TRUE)
        header("Location: ../views/login.php");
    else
    {
        $_SESSION['err']['code'] = "Incorrect username/confirmation code provided";
        header("Location: ../views/reset_passwd.php");
    }
}
if (isset($_GET['old']) && isset($_GET['new']))
    change_password($db, $_GET['old'], $_GET['new']);
?>