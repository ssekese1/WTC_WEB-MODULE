<?php
session_start();
// print_r($_SESSION);
    require_once 'header.php';  
    if (!isset($_SESSION['username']) || !isset($_SESSION['passwd']))
         header("Location: login.php");
// if (isset($_SESSION['username']))
// {
//     echo $_SESSION['username'];
// }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <script>
    function chat_ajax()
    {
        var msg = document.getElementById("msg");
        var to = document.getElementById("to");
        msgs = msg.value;
        to = to.value;
        var req = new XMLHttpRequest();
        try{ 
        req.onreadystatechange = function()
        { 
            if(req.readyState == 4 && req.status == 200)
            {
                //document.getElementById('posts').innerHTML = req.responseText;
                getData();
                msg.value = "";
            }
        }
        req.open('GET', '../server/send.php?to=' + to + "&msg=" + msgs, true); 
        req.send();
        }
        catch(Exception)
        {}
    }
    function getData()
    {
        var to = document.getElementById("to");
        to = to.value;
        var req = new XMLHttpRequest(); 
        req.onreadystatechange = function()
        { 
            if(req.readyState == 4 && req.status == 200)
            {
                document.getElementById('posts').innerHTML = req.responseText;
            }
        }
        req.open('GET', '../server/send.php?to=' + to, true); 
        req.send();
    }
    window.setInterval(()=>{
        getData();
    }, 1000);
</script>
</head>
<body>
<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$usr = $_GET['usr'];
$stmt = $db->prepare 
(
    "SELECT *
     FROM `users` WHERE username='$usr'"
    );
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($results);
if ($results)
{
    try
    {
        
            foreach($results as $rowstatus)
            {
                if ($rowstatus['online_status'] == 1)
                {
                    echo $usr;
                    echo " is online";
                }
                else
                {
                    $last = $rowstatus['created'];
                    echo "offline";
                    echo"<br />";
                    echo "last seen $last";
                }
            }
        
    }
    catch(PDOException $e)
        {
            echo "failed:<br>".$e->getMessage();
            return (FALSE);
        }
    }

        ?>
<div class="output" id="posts">
</div>
<form>
<textarea name="msg" placeholder="Type to send message..." class="form_control" id="msg"></textarea>
<br >
<input type="hidden" value="<?php echo $_GET['usr']?>" id="to"/>
</form>
<button class="btn btn-primary" onclick="chat_ajax()">Send</button>
<?php
include_once 'footer.php';
?>
</body>
</html>
