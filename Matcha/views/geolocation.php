<!DOCTYPE html>
<html>
<head>
	<title>login Form</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div id="map"></div>
<script>

if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
        function(position) {
   // alert("Latitude: " + position.coords.latitude + "\nLongitude: " + position.coords.longitude);
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    var location = new google.maps.LatLng(lat, lon)
    var map = document.getElementById('map')
    map.style.height = '500px';
    map.style.width = '500px';

    var mapOptions = {
    center:location,zoom:14,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    // navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    
    var map = new google.maps.Map(document.getElementById("map"),mapOptions);
    var marker = new google.maps.Marker({position: location,
    animation: google.maps.Animation.BOUNCE, map: map, title: "You are here!"
  });
  // marker.setMap(map);
        },
         function(error){
             alert(error.message);
             switch(error.code) {
                case error.PERMISSION_DENIED:
                 alert("User denied the request for Geolocation.");
                  break;
                case error.POSITION_UNAVAILABLE:
                  alert("Location information is unavailable.");
                  break;
                case error.TIMEOUT:
                  alert("The request to get user location timed out.");
                  break;
                case error.UNKNOWN_ERROR:
                  alert("An unknown error occurred.");
                  break;
               }

             }, {
                     enableHighAccuracy: true,
                     timeout : 5000
                 } );
} else { 
    error('Geolocation is not supported by this browser.');
}
</script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzZzORvlg1ds88TdJD_IDdzWS1EnwZvN4  "
    async defer></script>
</body>
</html>
