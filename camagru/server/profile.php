<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function check_user($db, $usr, $email)
{
    $sql = "SELECT * FROM users";
    try
    {
        $username = $_SESSION['username'];
        if ($_SESSION['username'] != $usr)
            $sql1= "UPDATE users SET username='$usr' WHERE username='$username'";
            $sql3= "UPDATE images SET username='$usr' WHERE username='$username'";
            $sql4= "UPDATE comments SET username='$usr' WHERE username='$username'";
            $sql5= "UPDATE likes SET username='$usr' WHERE username='$username'";
        if ($_SESSION['email'] != $email)
            $sql2 = "UPDATE users SET email='$email' WHERE username='$usr'";
        foreach($db->query($sql) as $row)
        {
            if (($usr == $row['username'] && $_SESSION['username'] != $usr) || ($email == $row['email'] && $_SESSION['username'] != $row['username']))
            {
                echo "Username and/or email already exists";
                return (FALSE);
            }
        }
        if (strlen($sql1) > 0)
        {
            $db->exec($sql1);
            $db->exec($sql3);
            $db->exec($sql4);
            $db->exec($sql5);
            $_SESSION['username'] = $usr;
        }
        if (strlen($sql2) > 0)
        {
            $db->exec($sql2);
            $_SESSION['email'] = $email;
        }
    }
    catch (PDOException $e)
    {
        echo "Check_user Failed: <br/>".$e->getMessage();
    }
    return (TRUE);
}

function validate_data($db, $data)
{
    if (!preg_match("^[a-zA-Z]+$^", $data['username']))
        $_SESSION['err']['username'] = "Only letters and white space allowed";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $_SESSION['err']['email'] = "Invalid email format";
    if (!check_user($db, $data['username'], $data['email']))
        $_SESSION['err']['exists'] = "Username and/or email already exists";
    if (isset($_SESSION['err']))
        return (FALSE);
    return (TRUE);
}

if (isset($_POST["update_user"]))
{
    $var = validate_data($db, $_POST);
    if ($var === TRUE)
    {
        check_user($db, $_POST['username'], $_POST['email']);
        header("Location: ../index.php");
        return (TRUE);
    }
}
?>