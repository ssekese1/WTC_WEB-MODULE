<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function check_user($db, $usr, $email)
{
    $stmt = $db->prepare("SELECT * FROM `users`");
    $results = $stmt->execute();
    $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
    try
    {
        foreach($results as $row)
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
// checking age of a registering person
 function ft_get_age()
 {
    // $date = DateTime::createFromFormat('Y', $_POST['bday']); // Pass your $_POST['born']
    // $cdate = new DateTime();
    // $age= $cdate->format('Y') - $date->format('Y');
   
    $dob=$_POST['bday'];
    $age = (date('Y') - date('Y',strtotime($dob)));
    return $age;
}
 
function validate_data($db, $data)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z]+$^", $data['Firstname']))
        $_SESSION['err']['Firstname'] = "Only letters allowed";
    if (!preg_match("^[a-zA-Z]+$^", $data['Lastname']))
        $_SESSION['err']['Lastname'] = "Only letters allowed";
    if (!preg_match("/^[0-9a-zA-Z_]{5,8}$/", $data['username']))
        $_SESSION['err']['username'] = "Username must be 5 - 8 characters and contain only digits, letters and underscore!";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $_SESSION['err']['email'] = "Invalid email format";
        if (!DateTime::createFromFormat("Y-m-d", $data["bday"]))
        $_SESSION['err']['bday'] = "Date must comply with this mask: YYYY-MM-DD";
    if(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/", $data['pswd']))
        $_SESSION['err']['pswd'] = "Password must have One Uppercase letter, a number and no less than than 8 characters!";
    if ($data['pswd'] != $data['re-pswd'])
        $_SESSION['err']['re-pswd'] = "The two passwords do not match";
    if (!check_user($db, $data['username'], $data['email']))
        $_SESSION['err']['exists'] = "Username and/or email already exists";
    if (isset($_SESSION['err']))
    {
        print_r($_SESSION);
        return (FALSE);
    }
     else echo "Validation passed, but you are underage, why dont you wait until you are 18?!?";
     return (TRUE);
}


function store_tmp_data($db, $data)
{
    $fname = $data['Firstname'];
    $lname = $data['Lastname'];
    $usr = $data['username'];
    $bday = $_POST['bday'];
    $email = $data['email'];
    $pswd = hash('whirlpool', $data['pswd']);
    $code = rand(10000, 99999);
    $codes = hash('whirlpool', $code);
    $stmt = $db->prepare("INSERT INTO temp_users(Firstname, Lastname, username, DOB, email, `passwd`, confirm_code) VALUES ('$fname', '$lname','$usr','$bday', '$email', '$pswd', '$codes')");
    try
    {
        $results = $stmt->execute();
        $str = sprintf("Greetings %s.\n\nPlease use the confirmation code: %d to finalize your registration process.", $usr, $code);
        $str = sprintf("%s\n\nWarm regards\nMatcha Team", $str);
        mail($email, "Matcha Account Activation", $str);
        return (TRUE);
    }
    catch (PDOException $e)
    {
        echo "Registration Failed: <br/>".$e->getMessage();
    }
    return (FALSE);
}

if (isset($_POST['reg_user']) )
{
    $var = validate_data($db, $_POST);
    echo "me";
    if ($var === TRUE)
    {
        echo "me";
        $ok = ft_get_age($_POST['bday']);
        if ($ok >= 18)
        {
        store_tmp_data($db, $_POST);
        header("Location: ../views/confirm_code.php");
        return (TRUE);
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Sorry, you cannot be using this site, you are underage")';
            echo '</script>';
            return FALSE;
            header("Location: ../index.php");
            
        }
    }
    header("Location: ../index.php");
}

?>