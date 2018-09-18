<?php
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function verify_user($db, $usr, $code)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z]+$^", $usr))
    {
        $_SESSION['err']['username'] = "Only letters, dashes and white space allowed, Username must start with an Uppercase";
        return (FALSE);
    }
    $code = hash('whirlpool', $code);
    $sql = "SELECT * FROM temp_users";
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($usr == $row['username'] && $code == $row['confirm_code'])
            {
                $email = $row['email'];
                $pswd = $row['password'];
                $sql2 = "INSERT INTO users(username, email, passwd, confirm_code) VALUES ('$usr', '$email', '$pswd', 'Verified')";
                $db->exec($sql2);
                $sql = "DELETE FROM temp_users WHERE username='$usr'";
                $db->exec($sql);
                return (TRUE);
            }
        }
    }
    catch(PDOException $e)
    {
        echo "Confirmation code failed:<br>".$e->getMessages();
    }
    return (FALSE);
}

if (isset($_POST['username']) && isset($_POST['code']))
{
    $var = verify_user($db, $_POST['username'], $_POST['code']);
    if ($var === TRUE)
        header("Location: ../views/login.php");
    else
    {
        $_SESSION['err']['code'] = "Incorrect username/confirmation code provided";
        header("Location: ../views/confirm_code.php");
    }
}
?>