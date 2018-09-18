<?php
session_start();
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
if (!file_exists("../gallery/"))
{
    mkdir("../gallery", 0777, TRUE);
}

$id = $_SESSION['id'];

if (isset($_POST['submit']))
{
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName); //returns an array of data
    $fileActualExt = strtolower(end($fileExt)); //returns the last item in the array then lowercases it

    $allowed = array('jpg');

    if (in_array($fileActualExt, $allowed))
     {
        if ($fileError === 0) 
        {
            if ($fileSize < 1000000) 
            {
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = '../gallery/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $stmt = $db->prepare("UPDATE profileimg SET status=0 WHERE userid='$id';");
                $stmt->execute();
               header("Location: ../views/pictures.php");
            } 
            else 
            {
                echo "Your file is too big!";
            }
        } 
        else
         {
            echo "There was an error uploading your file!";
        }
    } 
    else 
    {
        echo "You cannot upload files of this type, only jpgs are allowed!";
    }

}
?>
</body>
</html>
