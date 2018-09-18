<!DOCTYPE html>
<html>
<head>
	<title>login Form</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<center><h1>Login</h1></center>
	<div class="container">
		<form method="post" action="../server/sign_in.php">
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username" placeholder="enter username" required>
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="pswd" placeholder="enter your password" required>
			</div>
			<?php session_start(); if(isset($_SESSION['err']['sign_in'])) {echo $_SESSION['err']['sign_in']; $_SESSION['err']['sign_in'] = '';}?>
			<div class="input-group">
				<button type="submit" class="btn" name="login_user" value="ok">Login</button>
			</div>
			<p>
				<a href="forgot_passwd.php">Forgot Password<a/>
			</p>
			<p>
				Not yet a member? <a href="register.php">Sign up Here</a>
			</p>
		</form>
	</div>
	<div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>
</body>
</html>
