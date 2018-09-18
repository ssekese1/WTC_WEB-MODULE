<!DOCTYPE html>
<html>
<head>
<title>login Form</title>
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
<h1><center>Sign In</center></h1> 
<div class="small-container">
  <form method="post" action="../server/sign_in.php">
  <hr>
	<div class="form-group">
	  <label class="control-label">Username</label>
	  <input type="text" class="form-control" required="" autocomplete="off" name="username" placeholder="enter username" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>" >
	  <span class="text-danger"> <?php if (isset($_SESSION['err']['sign_in'])) {echo $_SESSION['err']['usersign_inname']; echo $_SESSION['err']['sign_in'] = '';}?></span>
	</div>
	<div class="form-group">
	  <label class="control-label">Password</label>
	  <input type="password" class="form-control" required="" name="pswd" placeholder="Enter own password" >
	  <span class="text-danger"> <?php if (isset($_SESSION['err']['sign_in'])) {echo $_SESSION['err']['sign_in']; $_SESSION['err']['sign_in'] = '';}?></span>
	</div>
	<div class="form-group">
	  <button type="submit" class="btn btn-primary" name="login_user" value="ok">Sign In</button>
	</div>
	<?php if(isset($_SESSION['err']['sign_in'])) {echo $_SESSION['err']['sign_in']; $_SESSION['err']['sign_in'] = '';}?>
		  <p>
			  <a href="./forgot_passwd.php">Forgot Password<a/>
		  </p>
		  <p>
			  Not yet a member? <a href="../index.php">Sign up Here</a>
		  </p>
</hr>
  </form>
</div>
	<div class="footer">
        <p class="copyright">&copy;ssekese 2018</p>
    </div>
</body>
</html>
