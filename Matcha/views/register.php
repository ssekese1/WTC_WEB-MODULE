<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>

</head>
<body>
  
   <h1><center>Sign Up</center></h1> 
  <div class="container" >
    <form method="post" action="./server/register.php">
    <hr>
    <div class="form-group">
        <label for="Firstname" class="control-label">Firstname</label>
        <input type="text" class="form-control" required="" autocomplete="off" name="Firstname" placeholder="enter firstname" value="<?php if (isset($_POST['Firstname'])) echo $_POST['Firstname']; ?>" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['Firstname'])) {echo $_SESSION['err']['Firstname']; echo $_SESSION['err']['Firstname'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Lastname</label>
        <input type="text" class="form-control" required="" autocomplete="off" name="Lastname" placeholder="enter lastname" value="<?php if (isset($_POST['Lastname'])) echo $_POST['Lastname']; ?>" >
        <span class="text-danger"> <?php  if (isset($_SESSION['err']['Lastname'])) {echo $_SESSION['err']['Lastname']; echo $_SESSION['err']['Lastname'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Username</label>
        <input type="text" class="form-control" required="" autocomplete="off" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['username'])) {echo $_SESSION['err']['username']; echo $_SESSION['err']['username'] = '';}?></span>
      </div>
      <div class="form-group">
        <label for="" class="control-label">Date Of Birth</label>
        <input type="date" class="form-control" name="bday" required>
        <span class="text-danger"> <?php if (isset($_SESSION['err']['bday'])) {echo $_SESSION['err']['bday']; echo $_SESSION['err']['bday'] = '';}?></span>
        
      </div>
      <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email" class="form-control" required="" autocomplete="off" name="email" placeholder="enter email address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['email'])) {echo $_SESSION['err']['email']; echo $_SESSION['err']['email'] ='';}?></span>
        <span class="text-danger"> <?php if (isset($_SESSION['err']['exists'])) {echo $_SESSION['err']['exists']; echo $_SESSION['err']['exists'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Password</label>
        <input type="password" class="form-control" required="" name="pswd" placeholder="Enter own password" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['pswd'])) {echo $_SESSION['err']['pswd']; $_SESSION['err']['pswd'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Re-Password</label>
        <input type="password" class="form-control" required="" name="re-pswd" placeholder="Re-enter own password" >
        <span class="text-danger"> <?php if (isset($_SESSION['err']['re-pswd'])) {echo $_SESSION['err']['re-pswd'];  $_SESSION['err']['re-pswd'] = '';}?></span>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="reg_user">Register</button>
      </div>
      <p>
        Already a member? <a href="views/login.php">Sign in Here</a>
      </p>
</hr>
    </form>
    </div>
</body>
</html>