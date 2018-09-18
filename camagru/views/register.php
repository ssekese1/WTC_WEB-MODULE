<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <center><h1>Register</h1></center>
  <div class="container">
    <div class="form">
    <form method="post" action="../server/register.php">

      <div class="input-group">
        <label>Username</label>
        <input type="text" required="" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
        <span class="error">* <?php session_start(); if (isset($_SESSION['err']['username'])) {echo $_SESSION['err']['username']; echo $_SESSION['err']['username'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" required="" name="email" placeholder="enter email address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
        <span class="error">* <?php if (isset($_SESSION['err']['email'])) {echo $_SESSION['err']['email']; echo $_SESSION['err']['email'] ='';}?></span>
        <span class="error">* <?php if (isset($_SESSION['err']['exists'])) {echo $_SESSION['err']['exists']; echo $_SESSION['err']['exists'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Password</label>
        <input type="password" required="" name="pswd" placeholder="Enter own password" >
        <span class="error">* <?php if (isset($_SESSION['err']['pswd'])) {echo $_SESSION['err']['pswd']; $_SESSION['err']['pswd'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Re-Password</label>
        <input type="password" required="" name="re-pswd" placeholder="Re-enter own password" >
        <span class="error">* <?php if (isset($_SESSION['err']['re-pswd'])) {echo $_SESSION['err']['re-pswd'];  $_SESSION['err']['re-pswd'] = '';}?></span>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
      </div>
      <p>
        Already a member? <a href="login.php">Sign in Here</a>
      </p>
    </form>
  </div>
  </div>
  <div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>