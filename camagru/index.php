<?php
require_once './config/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
	
<body>
	<div class="content">
		<div class="topnav" id="myTopnav">
			<?php
				if (isset($_SESSION['username']) && isset($_SESSION['passwd']) && isset($_SESSION['email']))
				{	
					echo "<a href=\"./views/welcome.php\">Camagru</a> ";
					echo "<a href=\"./server/logout.php\">Sign Out</a> ";
				}
				else
				{
					echo "<a href=\"./views/register.php\">Sign Up</a> ";
					echo "<a href=\"./views/login.php\">Sign In</a> ";
				}
			?>
		</div>
	</div>

<?php
require_once './server/paging.php';

?>
</body>
</html>
