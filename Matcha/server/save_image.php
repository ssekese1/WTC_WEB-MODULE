<?php
    opcache_reset();
    
    $val = rand();
    require_once '../config/connect.php';
    $db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

    if (isset($_POST['img']))
    {
        if (!file_exists("../gallery/"))
        {
            mkdir("../gallery", 0777, TRUE);
        }
        $db_file = sprintf("%d.jpg", $val);
        $file = sprintf("../gallery/%d.jpg", $val);
        if (file_exists($file))
        {
            while(file_exists($file))
            {
                $db_file = sprintf("%d.jpg", $val);
                $file = sprintf("../gallery/%d.jpg", $val);
            }
        }
        $data = explode(',', $_POST['img']);
        $data = base64_decode($data[1]);
        file_put_contents($file, $data);
        try
        {
            $usr= $_SESSION['username'];
            $query = "INSERT INTO images (name, username)
                VALUES ('$db_file', '$usr')";
            $db->exec($query);
            header('Location: ../views/welcome.php');
        }
        catch(PDOException $e)
        {
            echo $query."<br>".$e->getMessage();
        }
        header("Location: ../views/welcome.php");
    }
?>