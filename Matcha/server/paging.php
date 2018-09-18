<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_GET['id'];    
$results = $db->prepare 
(
    "SELECT SQL_CALC_FOUND_ROWS *
    FROM `images` ORDER BY created DESC WHERE id=$id"
);
$results->execute();
$results = $results->FetchAll(PDO::FETCH_ASSOC);
print_r($results);
?>
<!DOCTYPE html>
<html>
<head>
    <title>pagination</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <?php foreach($results as $result): ?>
            <?php
            if (isset($_SESSION['username']) && isset($_SESSION['passwd']) && isset($_SESSION['email']))
			{
				$str = sprintf("<a href=\"review.php?id=%s\"><img id='pics' src=\"../gallery/%s\"/></a>", $result['id'], $result['name']);
                echo $str;
            }
             else
             echo "An error occured";
            //  echo '<img class="pics" src="../gallery/'.$result['name'].'"/>'; 
            ?>
        <?php endforeach; ?>
</body>
<!-- <div class="footer">
        <p class="copyright">&copy;ssekese 2018</p>
	</div>
	 -->
</html>