<?php
require_once './config/setup.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
  
  
<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Matcha</a>
	</div>
	
    <div class="topnav-right"> 
			<?php
				if (isset($_SESSION['username']) && isset($_SESSION['passwd']) && isset($_SESSION['email']))
				{	
					
					
					echo '<li><a href="./views/welcome.php"><span class="glyphicon glyphicon-user"></span>Matcha</a></li>';
					echo '<li><a href="./server/logout.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a></li>';
				}
				else
				{
					
					echo '<li><a href="./views/login.php"><span class="glyphicon glyphicon-log-in"></span>Sign In</a></li>';
				}
			?>
	</div>
	</div>
</nav>
<div class="col-md-6"> 
	<p><h3>Hi, this is <i>Matcha</i>...Where hearts meet...</h3>
	<p id="motto"><h1>Find a date today.</h1></p>
	<p><b><h2>More singles who are more your style.</h2></b></p>
	<p><h3>40,000,000 singles worldwide<br />
	and 3 million messages sent daily.<h3></p>
</div>
<div class="col-md-6"> 
<?php
include_once './views/register.php'
?> 
</div>

<div class="footer">
    <p class="copyright">&copy;ssekese 2018</p>
</div>
</body>
</html>
