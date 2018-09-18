<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    </style>
</head>
<script src="../server/photo.js"></script>
<body>
<div class="content">
		<div class="topnav" id="myTopnav">
			<a href="../server/get_images.php">My Pictures</a>
            <a href="../">Gallery</a>
            <a href="../views/profile.php">My Profile</a>
			<a href="../server/logout.php">Sign Out</a>
</div>
</div>
<script>
    var sup_src = '';
    function superpossable(el) {
        sup_src = el;
        alert("Now Take a Picture...");
    }
</script>

<h1 class="page-header">Hi, <b><?php echo $_SESSION['username']; ?></b> Welcome to Camagru at WeThinkCode!</h1>
<div class="booth">
    <!-- VIDEO STREAM -->
    <video id="video" width="400" height="300"></video>
    <a href="#" id="capture" class="booth-capture-button">Take Photo</a>
    <!-- HIDDEN CANVAS STORES IMAGE DATA -->
    <canvas id="canvas" width="400" height="300" style="display: none;"></canvas>
        
    <script src="../server/photo.js"></script>
    <!-- UPLOADS IMAGES -->
    <form method="post" action="../server/upload.php" enctype="multipart/form-data">
        <input type="file" id="photo" name="image" id="image">
        <input type="submit" value="Upload" name="submit">
    </form>
</div>
<div class="clear"></div>    
    <!-- SUPERPOSABLES -->
    <div>
    <div style="display: flex;">
        <img src="../img/Birthday.png" alt="Birthday" style="width: 400px;height:300px; flex:1;" onclick="superpossable(this)">
        <img src="../img/s.png" alt="spectacles" style="width:400px; height:300px; flex:1;" onclick="superpossable(this)">
        <img src="../img/Love.png" alt="Love" style="width:400px; height:300px; flex:1;" onclick="superpossable(this)">
    </div>
    </div>

<!-- HIDDEN FORM, SAVES IMAGE INFO -->
<div>
    <form method="post" action="../server/save_image.php" id="save">
		<input type="hidden" value="" name="img" id="img"/>
		<input type="hidden" value="" name="supa" id="supa"/>
	</form>
</div>
	<div class="footer">
            <p class="copyright">&copy;ssekese 2018</p>
        </div>

</body>
</html>