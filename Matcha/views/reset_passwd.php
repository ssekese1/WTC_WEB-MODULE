<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Latest compiled and minified CSS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/style.css">
<body>
  <center><h1>Reset Password</h1></center>
  <div class="small-container">
    <!-- <div class="form"> -->
    <form method="post" action="../server/reset_passwd.php">
    <hr>
    <div class="form-group">
        <label class="control-label">Username</label>
        <input type="text" class="form-control" required="" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="text-danger"><?php session_start(); if (isset($_SESSION['err']['c_username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username']= '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Confirmation code</label>
        <input type="text" class="form-control" required="" name="code" placeholder="Enter code from email" >
        <span class="text-danger"><?php if (isset($_SESSION['err']['code'])) {echo $_SESSION['err']['code']; $_SESSION['err']['code'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Password</label>
        <input type="password" class="form-control" required="" name="pswd" placeholder="Enter new password" >
        <span class="text-danger"><?php if (isset($_SESSION['err']['pswd'])) {echo $_SESSION['err']['pswd']; $_SESSION['err']['pswd'] = '';}?></span>
      </div>
      <div class="form-group">
        <label class="control-label">Re-Password</label>
        <input type="password" class="form-control" required="" name="re-pswd" placeholder="Re-enter new password" >
        <span class="text-danger"><?php if (isset($_SESSION['err']['re-pswd'])) {echo $_SESSION['err']['re-pswd']; $_SESSION['err']['re-pswd'] = '';}?></span>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="reg_user">Reset</button>
      </div>
    </form>
    </hr>
  <!-- </div> -->
  </div>
  <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>