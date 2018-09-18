<?php
include_once("connect.php");


if (1)
{
    try
    {
       
        $conn = db_conn($DB_DSN_SET, $DB_USER, $DB_PASSWORD);
        $data = file_get_contents("config/sql/database.sql");
        
        $conn->exec($data);

        if ($conn)
        {
            $conn = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
            $conn->exec(file_get_contents("config/sql/temp_users.sql"));
            $conn->exec(file_get_contents("config/sql/table.sql"));
            $conn->exec(file_get_contents("config/sql/images.sql"));
            // $conn->exec(file_get_contents("config/sql/login_dets.sql"));?
            $conn->exec(file_get_contents("config/sql/posts.sql"));
            $conn->exec(file_get_contents("config/sql/profileimg.sql"));
            // $conn->exec(file_get_contents("config/sql/gender.sql"));
            // $conn->exec(file_get_contents("config/sql/sexualpreference.sql"));
            // $conn->exec(file_get_contents("config/sql/chats.sql"));
            $conn->exec(file_get_contents("config/sql/friend_requests.sql"));
        }
    }
    catch (PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
    
}

?>