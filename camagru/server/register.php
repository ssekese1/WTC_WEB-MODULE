<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function check_user($db, $usr, $email)
{
    $sql = "SELECT * FROM users";
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($usr == $row['username'] || $email == $row['email'])
                return (FALSE);
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
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z]+$^", $data['username']))
        $_SESSION['err']['username'] = "Only letters and white space allowed";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $_SESSION['err']['email'] = "Invalid email format";
    if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $data['pswd']))
        $_SESSION['err']['pswd'] = "Password must have One Uppercase letter, a number and no less than than 8 characters!";
    if ($data['pswd'] != $data['re-pswd'])
        $_SESSION['err']['re-pswd'] = "The two passwords do not match";
    if (!check_user($db, $data['username'], $data['email']))
        $_SESSION['err']['exists'] = "Username and/or email already exists";
    if (isset($_SESSION['err']))
        return (FALSE);
        else echo "please sing into ur account to confirm registration";
    return (TRUE);
}

function store_tmp_data($db, $data)
{
    $usr = $data['username'];
    $pswd = hash('whirlpool', $data['pswd']);
    $email = $data['email'];
    $code = rand(10000, 99999);
    $codes = hash('whirlpool', $code);

    $sql = "INSERT INTO temp_users(username, email, `password`, confirm_code) VALUES ('$usr', '$email', '$pswd', '$codes')";
    try
    {
        $db->exec($sql);
        $str = sprintf("Greetings %s.\n\nPlease use the confirmation code: %d to finalize your registration process.", $usr, $code);
        $str = sprintf("%s\n\nWarm regards\nCamagru Team", $str);
        mail($email, "Camagru Account Activation", $str);
        return (TRUE);
    }
    catch (PDOException $e)
    {
        echo "Registration Failed: <br/>".$e->getMessage();
    }
    return (FALSE);
}

if (isset($_POST['reg_user']))
{
    $var = validate_data($db, $_POST);
    if ($var === TRUE)
    {
        store_tmp_data($db, $_POST);
        header("Location: ../views/confirm_code.php");
        return (TRUE);
    }
    header("Location: ../views/register.php");
}

?>