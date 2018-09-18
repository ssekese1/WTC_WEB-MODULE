<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

// include_once "../views/profilepic.php";
require_once 'header.php';  
// require_once "../views/geolocation.php";

?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>

<h1 class="page-header">Hi, <b><?php echo $_SESSION['username']; ?></b> Welcome, Meet new and exciting people here!

<form action="match.php" METHOD="POST" >
<div class="form-group">
    <label for="searchtype">Fame Rating</label>
    <select class="form-control" name="fame">
    <option value="" selected disabled hidden>Choose Fame Rating</option>
        <option value="less">1 - 99</option>
        <option value="more">100 - 200</option>
        <option value="very">300+ </option>
    </select>
    <!-- <!-- <input type="submit">  -->
    </div>

    </div>
    <div class="form-group">
    <label for="searchtype">Age</label>
    <select class="form-control" name="age">
    <option value="" selected disabled hidden>Choose Age compatability</option>
        <option value="teenage">18 - 25</option>
        <option value="adult">26 - 30</option>
        <option value="mature">31+ </option>
    </select>
    <!-- <input type="submit"> -->
    </div>

    <div class="form-group">
    <label for="searchtype">Sexual Preference</label>
    <select class="form-control" name="sex">
    <option value="" selected disabled hidden>Choose prefered sexual interest</option>
        <option value="homo">Men</option>
        <option value="hetero">Female</option>
        <option value="bi">Both</option>
    </select>
    <!-- <!-- <input type="submit">  -->
    </div>

    <div class="form-group">
    <label for="searchtype">Interests</label>
    <select class="form-control" name="interests">
    <option value="" selected disabled hidden>Choose here prefered interests</option>
        <option value="AB">#Kart Racing</option>
        <option value="CD">#Gym</option>
        <option value="EF">#Vegan</option>
    </select> 
    <input type="submit" value="Filter" name"filter">
    </div>
</form>
<?php

// require_once "likeprofile.php";
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

//query    
$stmt = $db->prepare 
(
    "SELECT *
     FROM `users`"
    );
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

try
{
    if($results)
    {
            $stmt = $db->prepare("SELECT * FROM profileimg");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);
           
                foreach($result as $row)
                {
                     $id = $row['userid'];
                    echo "<div>";
                    if(($row['status']) == 0)
                    {
                        echo "<img class='ProfilePic' src='../gallery/profile".$id.".jpg'/>";
                         echo $row['username'];
                        
                        echo "<br />";
                        echo "<button><a href='profile_view.php?id=$id''/>View Profile!</button>";
                    }
                    else
                    {
                        echo "<img class='ProfilePic' src='../img/avatar.png'>";
                         echo $row['username'];
                        
                        echo "<br />";
                        echo "<button><a href='profile_view.php?id=$id'/>View Profile!</button>";
                    }
            }
                echo "</div>";

            
        }
    else
    echo "no users registered yet!";

}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
<?php
include_once 'footer.php';
?>

</body>
</html>