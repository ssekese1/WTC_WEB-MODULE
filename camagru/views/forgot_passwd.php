<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <center><h1>Forgot Password</h1></center>
  <div class="container">
    <div class="form">
    <form method="post" action="../server/forgot_passwd.php">

      <div class="input-group">
        <label>Username</label>
        <input type="text" required="" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="error">* <?php session_start(); if (isset($_SESSION['err']['c_username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username'] = '';}?></span>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Get code</button>
      </div>
    </form>
  </div>
  </div>
  <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>