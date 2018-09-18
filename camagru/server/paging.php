<?php
require_once './config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
   
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perpage = isset($_GET['per_page']) ? (int)$_GET['per_page]'] : 5;
//positioning
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

    
//query    
$results = $db->prepare 
(
    "SELECT SQL_CALC_FOUND_ROWS *
    FROM `images` ORDER BY created DESC
    LIMIT $start, {$perpage}"
);
$results->execute();
$results = $results->FetchAll(PDO::FETCH_ASSOC);
//pages
$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total']."<br/>";
$pages = ceil($total/$perpage);

?>
<!DOCTYPE html>
<html>
<head>
    <title>pagination</title>
  <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
    <?php foreach($results as $result): ?>
        <div class="result">
            <p>
            <?php
            if (isset($_SESSION['username']) && isset($_SESSION['passwd']) && isset($_SESSION['email']))
			{
				$str = sprintf("<a href=\"./views/review.php?id=%s\"><img class='pics' src=\"./gallery/%s\"/></a>", $result['id'], $result['name']);
                echo $str;
            }
                else
             echo '<img class="pics" src="./gallery/'.$result['name'].'"/>'; 
            ?>
            </p>
    </div>
        <?php endforeach; ?>
    <div class="pagination">
    <?php 
    for($number = 1; $number <= $pages; $number++) {
    ?>
    <a href="?page=<?=$number;?>&perpage=<?=$perpage; ?> "><?=$number; ?></a>
    </div>
    <?php } ?>


</body>
<div class="footer">
        <p class="copyright">&copy;ssekese 2018</p>
	</div>
	
</html>