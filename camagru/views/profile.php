<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['passwd']))
    header("Location: login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Your Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
  <center><h1>Profile Edit</h1></center>
<div class="container">
  <div class="form">
    <form method="post" action="../server/profile.php">
      <div class="input-group">
        <label>Username</label>
        <input type="text" required="" name="username" placeholder="enter username" value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>" >
        <span class="error">* <?php if (isset($_SESSION['err']['username'])) {echo $_SESSION['err']['username']; $_SESSION['err']['username'] = '';}?></span>
      </div>
      <div class="input-group">
        <label>Email</label>
        <input type="email" required="" name="email" placeholder="enter email address" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" >
        <span class="error">* <?php if (isset($_SESSION['err']['email'])) {echo $_SESSION['err']['email']; $_SESSION['err']['email'] = '';}?></span>
      </div>
      <div class="input-group">
        <button type="submit" class="btn" name="update_user">Update</button>
      </div>
      <div class="input-group">
        <input type="password" placeholder="Old password" name="old" id="old"></br>
        <input type="password" placeholder="New password" name="new" id="new"></br>
        <label id="pss"></label>
        <input type="button" class="btn" onclick="change_password()" value="Reset Password">
      </div>
        <div class="input-group">
          <label id="not">Notification(<?php if ($_SESSION['not'] != 'Yes') echo "Off"; else echo "On";?>)</label><input type="button" id="sen" onclick="set_not(this.value)" value="<?php if ($_SESSION['not'] == 'Yes') echo "off"; else echo "on";?>"/>
        </div>
    </form>
  </div>
  <div class="clear"></div>
</div>
<div class="footer">
    <p class="copyright">&copy;ssekese 2018</p>
</div>
  
  <script>
      var xmlhttp;
      if (window.XMLHttpRequest) 
        xmlhttp=new XMLHttpRequest();
      else
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// code for IE6, IE5
      function set_not(str) 
      {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        
        if (str.localeCompare("on") == 0)
        {
          document.getElementById("sen").value = "off";
          document.getElementById("not").innerHTML = "Notification(On)";
        }
        else
        {
          document.getElementById("sen").value = "on";
          document.getElementById("not").innerHTML = "Notification(Off)";
        }
        xmlhttp.open("GET","../server/notification.php?not="+str,true);
        xmlhttp.send();
      }
      function change_password()
      {
        var old = document.getElementById("old").value;
        var $new = document.getElementById("new").value;
        xmlhttp.onreadystatechange=function() 
        {
          if (this.readyState==4 && this.status==200) 
          {
            document.getElementById("pss").innerHTML=this.responseText;
          }
        }
        xmlhttp.open("GET","../server/reset_passwd.php?old="+old+"&new="+$new,true);
        xmlhttp.send();
      }

      function showUser(str) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>
</body>
</html>