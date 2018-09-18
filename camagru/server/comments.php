<?php 
require_once '../config/connect.php';

$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

$sql = "SELECT * FROM images";
$sql2 = "SELECT * FROM comments";
try
{
    foreach($db->query($sql) as $row)
    {
        if ($_SESSION['img']['id'] == $row['id'])
        {
            foreach($db->query($sql2) as $data)
            {
                if ($data['image'] == $row['name'])
                {
                    $str = sprintf("<p>%s (commented by: <b>%s</b> on %s)</p>", $data['comment'], $data['username'], $data['created']);
                    echo $str;
                }
            }
        }
    }
}
catch(PDOException $e)
{
    echo $e->getMessage();
}

?>