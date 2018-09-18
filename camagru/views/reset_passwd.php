<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <center><h1>Reset Password</h1></center>
  <div class="container">
    <div class="form">
    <form method="post" action="../server/reset_passwd.php">

      <div class="input-group">
        <label>Username</label>
        <input type="text" required="" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="error">* <?php session_start(); if (isset($_SESSION['err']['c_username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username']= '';}?></span>
      </div>
      <div class="input-group">
        <label>Confirmation code</label>
        <input type="text" required="" name="code" placeholder="Enter code from email" >
        <span class="error">* <?php if (isset($_SESSION['err']['code'])) {echo $_SESSION['err']['code']; $_SESSION['err']['code'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" required="" name="pswd" placeholder="Enter new password" >
        <span class="error">* <?php if (isset($_SESSION['err']['pswd'])) {echo $_SESSION['err']['pswd']; $_SESSION['err']['pswd'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Re-Password</label>
        <input type="password" required="" name="re-pswd" placeholder="Re-enter new password" >
        <span class="error">* <?php if (isset($_SESSION['err']['re-pswd'])) {echo $_SESSION['err']['re-pswd']; $_SESSION['err']['re-pswd'] = '';}?></span>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Reset</button>
      </div>
    </form>
  </div>
  </div>
  <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>