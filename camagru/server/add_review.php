<?php 
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function set_likes($db, $id)
{
    $sql = "SELECT * FROM images";
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($row['id'] == $id && $_SESSION['img']['id'] == $row['id'])
            {
                $img = $row['name'];
                $usr = $_SESSION['username'];
                $sql2 = "INSERT INTO likes(image, username) VALUES ('$img', '$usr')";
                $db->exec($sql2);
                header("Location: ../views/review.php?id=$id");
                return ;
            }
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
function get_email($db, $usr)
{
    $sql = "SELECT * FROM users";
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($row['username'] == $usr && $row['notification'] == "Yes")
                return ($row['email']);
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    return (FALSE);
}
function set_comments($db, $id, $comment)
{
    $sql = "SELECT * FROM images";
    $comment = strip_tags($comment);
    $comment = htmlspecialchars($comment);
    $comment = htmlentities($comment);
    $comment = addslashes($comment);
    try
    {
        foreach($db->query($sql) as $row)
        {
            if ($row['id'] == $id && $_SESSION['img']['id'] == $row['id'])
            {
                $img = $row['name'];
                $usr = $_SESSION['username'];
                $sql2 = "INSERT INTO comments(`image`, username, comment) VALUES ('$img', '$usr', '$comment')";
                $email = get_email($db, $row['username']);
                if ($email !== FALSE)
                {
                    $str = sprintf("%s has been commented on by %s\nPlease login to view comment.", $row['name'], $_SESSION['username']);
                    mail($email, "Camagru Update", $str);
                }
                $db->exec($sql2);
                header("Location: ../views/review.php?id=$id");
                return ;
            }
        }
    }
    catch(PDOException $e)
    {
        echo "error with images<br/>".$e->getMessage();
    }
}
if (isset($_POST['id']) && isset($_POST['like']))
    set_likes($db, $_POST['id']);
else if (isset($_POST['id']) && isset($_POST['com']) && isset($_POST['comment']))
    set_comments($db, $_POST['id'], $_POST['comment']);
?>