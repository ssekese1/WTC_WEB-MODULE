<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet"  href="../dist/css/bootstrap.min.css">

<!-- jQuery library -->
<link rel="stylesheet"  href="../dist/css/bootstrap-theme.min.css">

<!-- Latest compiled JavaScript -->
<script src="../dist/js/bootstrap.min.js"></script>
</head>
<body>
  <center><h1>Forgot Password</h1></center>
  <div class="small-container">
  <form method="post" action="../server/forgot_passwd.php">
	<div class="form-group">    
        <label class="control-label">Username</label>
        <input type="text"  class="form-control" required="" autocomplete="off" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="text-danger"><?php session_start(); if (isset($_SESSION['err']['c_username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username'] = '';}?></span>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="reg_user">Get code</button>
      </div>
    </form>
  </div>
  <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>