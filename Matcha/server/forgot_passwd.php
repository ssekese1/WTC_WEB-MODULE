<?php
require_once '../config/connect.php';
session_start();
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
function send_user_code($db, $usr)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z].{1,8}+$^", $usr))
        $_SESSION['err']['username'] = "Username must be 8 characters long!";
    $sql = "SELECT * FROM users";
    $code = rand(10000, 99999);
    $codes = hash('whirlpool', $code);
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($row['username'] == $usr)
            {
                $email = $row['email'];
                $sql2 = "UPDATE users SET confirm_code='$codes' WHERE username='$usr'";
                $db->exec($sql2);
                $str = sprintf("Greetings %s.\n\nPlease use the confirmation code: %d to reset your password.", $usr, $code);
                $str = sprintf("%s\n\nWarm regards\nMatcha Team", $str);
                mail($email, "Matcha Passowrd Reset", $str);
                return (TRUE);
            }
        }
    }
    catch(PDOException $e)
    {
        echo "Send user code failed:<br>".$e->getMessages();
    }
    $_SESSION['err']['username'] = "Username doesn't exist";
    return (FALSE);
}
if (isset($_POST['username']))
{
    if (send_user_code($db, $_POST['username']) === TRUE)
        header("Location: ../views/reset_passwd.php");
    else
        header("Location: ../views/forgot_passwd.php");
}
?>