<?php
    require_once '../config/connect.php';
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
    LIMIT $start, {$perpage} "
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
   <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <?php foreach($results as $result): ?>
        <div class="result">
            <p>
                <?php
                    if ($_SESSION['username'] == $result['username'])
                    {
                        $str = sprintf("<a href=\"../server/deleteimage.php?id=%s\">delete</a>", $result['id']);
                        $str = sprintf("<a href=\"../views/review.php?id=%s\"><img class=\"pics\" src=\"../gallery/%s\"/></a>%s", $result['id'],$result['name'], $str);
                        echo $str;
                    }
                ?>
            </p>
    </div>
    <?php endforeach; ?>
    <div class="pagination">
    <?php for($number = 1; $number <= $pages; $number++): ?>
    <a href="?page=<?php echo $number; ?>&perpage<?php echo $perpage; ?> "><?php echo $number; ?></a>
    </div>
    <?php endfor; ?>

    <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>

</body>
</html>