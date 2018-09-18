<?php
    require_once '../config/connect.php';
    $db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
    
$id = $_SESSION['id'];
try
{  
    $stmt = $db->prepare 
    (
        "SELECT SQL_CALC_FOUND_ROWS *
         FROM `images` ORDER BY created DESC" 
        );
    $stmt->execute();
    $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
    // print_r($results);
}
catch (PDOException $e)
{
    echo "Failed: <br/>".$e->getMessage();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php foreach($results as $result)
    {
                     if ($_SESSION['username'] == $result['username'])
                     {
                            $str = sprintf("<a href=\"../server/deleteimage.php?id=%s\">delete</a>", $result['id']);
                            echo '<img id="pics" src="../gallery/'.$result['name'].'"/>';
                            echo $str;
                      
                    }
                 
                        
    }
    ?>
    
    <form method="post" action="../server/upload.php" enctype="multipart/form-data">
    <input type="file" name="image" onchange="loadFile(event)">
    <image id="output">
    <input type="submit"  value="Upload" name="submit">
</form>
<script>
var loadFile = function(event) {
var output = document.getElementById('output');
output.src = URL.createObjectURL(event.target.files[0]);
};
</script>
</body>
</html>