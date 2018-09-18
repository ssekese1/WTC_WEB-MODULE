<?php
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function verify_user($db, $usr, $code, $pswd, $repswd)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z]+$^", $usr))
        $_SESSION['err']['username'] = "Only letters and white space allowed";
    if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $pswd))
        $_SESSION['err']['pswd'] = "Password must have One Uppercase letter, a number and no less than than 8 characters!";
    if ($repswd != $pswd)
        $_SESSION['err']['re-pswd'] = "The two passwords do not match";
    if (isset($_SESSION['err']))
        return (FALSE);
    $code = hash('whirlpool', $code);
    $pswd = hash('whirlpool', $pswd);
    $sql = "SELECT * FROM users";
    try
    {
        foreach($db->query($sql) as $row)
        {
            print_r($row);
            if ($usr == $row['username'] && $code == $row['confirm_code'])
            {
                $sql2 = "UPDATE users SET passwd='$pswd' WHERE username='$usr'";
                $db->exec($sql2);
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
    $sql = "SELECT * FROM users";
    $sql2 = "UPDATE users SET `passwd`='$new' WHERE username='$usr'";
    foreach($db->query($sql) as $row)
    {
        if ($row['username'] == $usr && $_SESSION['passwd'] == $row['passwd'])
        {
            if ($_SESSION['passwd'] == $pswd)
            {
                try
                {
                    $db->exec($sql2);
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