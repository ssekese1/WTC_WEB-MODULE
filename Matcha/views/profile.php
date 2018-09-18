<?php
    require_once 'header.php'; 

session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);

function validate_data($db, $data)
{
    $_SESSION = FALSE;
    if (!preg_match("^[a-zA-Z]+$^", $data['Firstname']))
        $_SESSION['err']['Firstname'] = "Only letters allowed";
    if (!preg_match("^[a-zA-Z]+$^", $data['Lastname']))
        $_SESSION['err']['Lastname'] = "Only letters allowed";
    if (!preg_match("/^[0-9a-zA-Z_]{5,8}$/", $data['username']))
        $_SESSION['err']['username'] = "Username must be 5 - 8 characters and contain only digits, letters and underscore!";
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        $_SESSION['err']['email'] = "Invalid email format";
        if (!DateTime::createFromFormat("Y-m-d", $data["bday"]))
        $_SESSION['err']['bday'] = "Date must comply with this mask: YYYY-MM-DD";
    if (isset($_SESSION['err']))
    {
        print_r($_SESSION);
        return (FALSE);
    }
     return (TRUE);
}
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$id = $_SESSION['id'];
$stmt=$db->prepare("SELECT * FROM `users` WHERE id=$id");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['update_user']) && validate_data($db, $_POST))
{
  
    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $email = $_POST['email'];
    $DOB = $_POST['bday'];
    $Biography = $_POST['bio'];
    
  try
  {

    $stmt = $db->prepare("UPDATE `users` SET Firstname='$Firstname', 
        Lastname = '$Lastname',
        email = '$email',
        DOB = '$DOB',
        Biography ='$Biography'
         WHERE id = $id");
    $result = $stmt->execute();
    if ($result)
    {
      
      echo "ur data has been updated";
      header("Location: profile.php?id=$id");
      
      return (TRUE);
      
    }
  }
  catch(PDOException $e)
  {
      echo $e->getMessage();
  }
    
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <!-- <center><h1>Edit Your Profile</h1></center> -->
  <!-- <div class='col-md-6'> -->


  <div class="container">
  <!-- <div class="row"> -->
  <!-- <div class="col"> -->
    <form method="POST" action="#">
    <?php
     Foreach($results as $row):
     ?>
    <hr>
  <center><h1>Edit Your Profile</h1></center>
    
    <div class="form-group">
        <label for="Firstname" class="control-label">Firstname</label>
        <input type="text" class="form-control" required="" name="Firstname" placeholder="enter firstname" value="<?php if (isset($_SESSION['username'])) echo $row['Firstname']; ?>" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['Firstname'])) {echo $_SESSION['err']['Firstname']; echo $_SESSION['err']['Firstname'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Lastname</label>
        <input type="text" class="form-control" required="" name="Lastname" placeholder="enter lastname" value="<?php if (isset($_SESSION['username'])) echo $row['Lastname']; ?>" >
        <span class='text-danger'> <?php  if (isset($_SESSION['err']['Lastname'])) {echo $_SESSION['err']['Lastname']; echo $_SESSION['err']['Lastname'] = '';}?></span>
      </div>

      <div class="form-group">
        <label class="control-label">Username</label>
        <input type="text" class="form-control" required="" name="username" placeholder="enter username" value="<?php if (isset($_SESSION['username'])) echo $row['username']; ?>" >
        <span class='text-danger'> <?php if (isset($_SESSION['err']['username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username'] = '';}?></span>
      </div>

      <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email" class="form-control" required="" name="email" placeholder="enter email address" value="<?php if (isset($_SESSION['username'])) echo $row['email']; ?>" >
        <span class='text-danger'> <?php if (isset($_SESSION['err']['email'])) {echo $_SESSION['err']['email']; $_SESSION['err']['email'] = '';}?></span>
      </div>

      <div class="form-group">
      <label for="" class="control-label">Date Of Birth</label>
      <input type="date" class="form-control" name="bday" value="<?php if (isset($_SESSION['username'])) echo $row['DOB']; ?>">
      <span class='text-danger'> <?php if (isset($_SESSION['err']['bday'])) {echo $_SESSION['err']['bday']; echo $_SESSION['err']['bday'] = '';}?></span>
    </div>
    <div class="form-group">
        <label class="control-label">Biography</label>
        <input type="text" class="form-control" name="bio" placeholder="Tell us about yourself" value="<?php if (isset($_SESSION['username'])) echo $row['Biography']; ?>" >
      </div>
  <?php endforeach ?>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="update_user">Update</button>
      </div>

      <p>
        For password and notification setting, please <a href="./notifications.php">Click Here</a>
      </p>
      </hr>
    </form>
  </div>
  <div class="clear"></div>
</div>
<div class="footer">
    <p class="copyright">&copy;ssekese 2018</p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>


        <?php
 echo "<div class=smallcontainer>";

   require_once "./interests.php";
  
    require_once "./gender.php";
   
    require_once "./sexualpreference.php";
  echo "</div>";
  // echo "</div>";
    
?>

<?php
require_once '../config/connect.php';
$db = db_conn($DB_DSN, $DB_USER, $DB_PASSWORD);
$username = $_SESSION['username'];
$stmt = $db->prepare("SELECT * FROM `friend_requests` WHERE user_to='$username' AND status = '1' OR user_from = '$username'");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($results)
{
  foreach($results as $row)
  {
    if ($row['status'] == 1)
    {
      $result = $row['status'];
    //  $count = $result->rowCount();
    //  print_r($result);
      
      //  $count = ($result);
      echo "you have " .$result. " likes";
    }
  }
 
}
?>

