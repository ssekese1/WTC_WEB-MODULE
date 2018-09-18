
<!DOCTYPE html>
<html>
<head>
	<title>Edit Your Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>


<?php
session_start();
require_once '../config/connect.php';
require_once 'header.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
//matching according to age
if (isset($_POST['age']) == 'teenage')
{
 //18 - 25 
    try
    {
        $sql = "SELECT * FROM users WHERE DOB > '1992-01-01' AND DOB < '2001-01-01'";
        $results=$db->prepare($sql);
        $results->execute();
        $results = $results->FetchAll(PDO::FETCH_ASSOC);
        // print_r($results);
        
        if($results)
        {
            foreach($results as $data)
            {
                $id = $data['id'];
              
                $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
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
        }
    
    }
    catch (PDOException $e)
    {
        echo "no users registered yet withing that age range!<br/>".$e->getMessage();
    }
    // header("Location: ../views/welcome.php");

}

else if (isset($_POST['age']) == 'adult')
{
    //26 - 30
    $_SESSION = FALSE;
    try
    {
        $sql = "SELECT * FROM users WHERE DOB > '1987-12-31' AND DOB < '1991-01-01'";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
        // print_r($results);
        if($results)
        {
            foreach($results as $data)
            {
                $id = $data['id'];
              
                $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
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
        }
    }
    catch (PDOException $e)
    {
        echo "No users above 25 yet!! <br/>".$e->getMessage();
    }
}

else if (isset($_POST['age']) == 'mature')
{
    $_SESSION = FALSE;
    
    //31+
    try
    {
        $sql = "SELECT * FROM users WHERE DOB < '1988-01-01'";
        $res=$db->prepare($sql);
        $res->execute();
        $rets = $res->FetchAll(PDO::FETCH_ASSOC);
        // print_r($rets);
        if($results)
        {
            foreach($rets as $data)
            {
                $id = $data['id'];
              
                $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
               
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
        }
    }
    catch (PDOException $e)
    {
        echo "No users above 30 yet!! <br/>".$e->getMessage();
    }
}


//matching with sexual preference
if (isset($_POST['sex']) == 'bi')
{
 //BI 
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
 catch (PDOException $e)
 {
     echo "No users above 30 yet!! <br/>".$e->getMessage();
 }
}

else if (isset($_POST['sex']) == 'homo')
{
    //homo
    try
    {
    if ($_SESSION['Gender'] == 'male')
       { 
            $sql = "SELECT * FROM users WHERE Gender ='male'";
            $stmt=$db->prepare($sql);
            $stmt->execute();
            $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
            // print_r($results);
       }
       else 
       {
            if ($_SESSION['Gender'] == 'female') 
            {
                $sql = "SELECT * FROM users WHERE Gender ='female'";
                $stmt=$db->prepare($sql);
                $stmt->execute();
                $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                if($results)
                {
                    foreach($rets as $data)
                    {
                        $id = $data['id'];
                      
                        $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                       
                            foreach($results as $row)
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
                }
            }
       }

    }
    catch (PDOException $e)
    {
        echo "No users yet <br/>".$e->getMessage();
    }
}

else if (isset($_POST['sex']) == 'hetero')
{
    //hetero
    try
    {
        if ($_SESSION['Gender'] == 'male')
       { 
            $sql = "SELECT * FROM users WHERE Gender ='female'";
            $stmt=$db->prepare($sql);
            $stmt->execute();
            $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
            if($results)
            {
                foreach($rets as $data)
                {
                    $id = $data['id'];
                  
                    $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   
                        foreach($results as $row)
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
            }
       }
       else
       {
            if ($_SESSION['Gender'] == 'female')
            {
                $sql = "SELECT * FROM users WHERE Gender ='male'";
                $stmt=$db->prepare($sql);
                $stmt->execute();
                $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
                // print_r($results);
                if($results)
                {
                    foreach($rets as $data)
                    {
                        $id = $data['id'];
                      
                        $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = $id ");
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                       
                            foreach($results as $row)
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
                }
            }
       }

    }
    catch (PDOException $e)
    {
        echo "No users yet<br/>".$e->getMessage();
    }
}


//now matching according to fame(adding likes is a challenge)
if (isset($_POST['fame']) == 'less')
{
 //1-99
    try
    {
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM users";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $results = $stmt->FetchAll(PDO::FETCH_ASSOC);
        
        if ($results)
        {
                
                $sql = "SELECT * FROM friend_requests WHERE status = 1";
                $results=$db->prepare($sql);
                $results->execute();
                $result = $results->FetchAll(PDO::FETCH_ASSOC);
                if($result)
                {
                    foreach($result as $data)
                    {
                        $id = $data['id'];
                    
                        $stmt = $db->prepare("SELECT * FROM profileimg WHERE userid = '$id' ");
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                            foreach($results as $row)
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
                }
            }
    }
    catch (PDOException $e)
    {
        echo "No users yet <br/>".$e->getMessage();
    }
}



?>
</body>
</html>


