<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

if (!file_exists("../gallery/"))
{
    mkdir("../gallery", 0777, TRUE);
}

$target_dir = "../gallery/";
$username = $_SESSION['username'];
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$pic = "gallery/".$username."/".basename($_FILES["image"]["name"]);
$imageFileType =strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) 
{
    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false)
    {
        echo '<script language="javascript">';
        echo 'alert("File is an image - " . $check["mime"] . ".")';
        echo '</script>';
        $uploadOk = 1;

    } 
    else 
    {
        echo '<script language="javascript">';
        echo 'alert("File is not an image.")';
        echo '</script>';
        
        $uploadOk = 0;
    }
}
    // Check if file already exists
    if (file_exists($target_file))
    {
        echo '<script language="javascript">';
        echo 'alert("Sorry, file already exists.")';
        echo '</script>';
        
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 20000000)
    {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file is too large.")';
        echo '</script>';
        
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) 
    {
        echo '<script language="javascript">';
        echo 'alert ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")';
        echo '</script>';
        
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0)
    {
        echo '<script language="javascript">';
        echo 'alert("Sorry, your file was not uploaded.")';
        echo '</script>';
        
    // if everything is ok, try to upload file
    }

else 
{
    // if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
    // {
        try
        {
            $id = $_SESSION['id'];
            $username = $_SESSION['username'];
            $stmt = $db->prepare("SELECT * FROM `images` WHERE username='$username'");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // print_r($_SESSION);
            if(count($results) < 4)
            {
                try
                {
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    
                    $nme = $_FILES["image"]["name"];
                    $stmt = $db->prepare("INSERT INTO images(username, name) VALUES('$username', '$nme')");
                    $results =$stmt->execute();

                }
                catch(PDOException $e)
                {
                    echo "upload limit reached: <br/>".$e->getMessage();
                }
                
            }
        }
        catch(PDOException $e)
        {
            echo "Image upload error: <br/>".$e->getMessage();
        }
    // } 
    // else 
    // {
    //     echo "Sorry, there was an error uploading your file.";
    // }
    header("Location: ../views/pictures.php");
}
?>
</body>
</html>
