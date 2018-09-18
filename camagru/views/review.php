<?php 
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

$sql = "SELECT * FROM images";

try
{
    foreach($db->query($sql) as $row)
    {
        if ($_GET['id'] == $row['id'])
        {
            $str = sprintf("../gallery/%s", $row['name']);
            $_SESSION['img']['src'] = $str;
            $_SESSION['img']['id'] = $_GET['id'];
        }
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>comment box</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <img id="rev" src="<?php echo $_SESSION['img']['src'];?>" alt="Missing image"/><br/>
    <form method='POST' action='../server/add_review.php'>
        <input type="hidden" value="<?php echo $_SESSION['img']['id'];?>" name="id"/>
        <input type="submit" name="like" value="like"/>
    </form>
    <iframe src="../server/likes.php"></iframe>
    <iframe src="../server/comments.php"></iframe>
    <form method='POST' action='../server/add_review.php'>
        <input type="hidden" value="<?php echo $_SESSION['img']['id'];?>" name="id"/>
        <textarea name='comment' place holder='Write Your Comment Here!'></textarea></textarea><br>
        <input type="submit" value="comment" name="com"/>
    </form>
    <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>
