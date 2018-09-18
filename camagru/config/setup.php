<?php
include_once("connect.php");


if (1)
{
    try
    {
       
        $conn = db_conn("mysql:host=localhost;", $DB_USER, $DB_PASSWORD);
        $conn->exec(file_get_contents("./sql/database.sql"));

        if ($conn)
        {
            $conn = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->exec(file_get_contents("./sql/temp_users.sql"));
            $conn->exec(file_get_contents("./sql/table.sql"));
            $conn->exec(file_get_contents("./sql/like.sql"));
            $conn->exec(file_get_contents("./sql/comments.sql"));
            $conn->exec(file_get_contents("./sql/images.sql"));
                       
        }
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
}

?>