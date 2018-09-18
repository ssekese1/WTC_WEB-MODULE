
<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['passwd']))
    header("Location: login.php"); 
        require_once 'header.php'; 

?>
<!DOCTYPE html>
<html>
<head>
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

  <title>Reset Details</title>
</head>
<body>
<div class="small-container">
<div class="form-group">
      <Label class="control-label" id="left">Reset Your Password Here</Label>
        <input type="password" class="form-control" required placeholder="Old password" name="old" id="old"></br>
        <input type="password" class="form-control" required placeholder="New password" name="new" id="new"></br>
        <label  id="pss"></label>
        <input type="button" class="btn btn-primary" onclick="change_password()" value="Reset Password">
      </div>
        <div class="form-group">
          <label class="control-label" id="not">Notification(<?php if ($_SESSION['not'] != 'Yes') echo "Off"; else echo "On";?>)</label>
          <input type="button" class="btn btn-primary" id="sen" onclick="set_not(this.value)" value="<?php if ($_SESSION['not'] == 'Yes') echo "off"; else echo "on";?>"/>
        </div>
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