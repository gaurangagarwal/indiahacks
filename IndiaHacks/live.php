<html>
<head>
	<title>Voyagers | Live</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<body>
<?php 
include('includes/header.php'); 
$postPlaceID = $_SESSION['place']['placeID'];
$postLocation = $_SESSION['place']['location'];
$commPos =  strpos($postLocation, ',');
$exactPlace = substr($postLocation, 0,$commPos); 
$notExactPlace = substr($postLocation, $commPos+1);
?>
<h1 align="center" style="color:black; font-weight:100; margin-top:3%; font-size:250%">WELCOME TO VOYAGERS LIVE</h1>
<h3 align="center" style="color:black; font-weight:100">
	Here you can see map for the location along with the approximate  distance and time for the trip.<br> Oh and yeah, 360 degree photoshperes
</h3>
<input type="text" value="<?php echo $_SESSION['place']['placeID'];?>" id="placeIDJS" style="display:none;">

<div id="map" style="display:none"></div>   <!---Map not displayed just for geolocation-->
<table border="1" width="100%">
	<tr>
		<td width="50%">
			<iframe id="mapFrame" width="100%" height="400"></iframe>
		</td>
		<td width="50%" style="color:black">
			  <h1 align='center' id='exactPlace' ><?php echo $exactPlace; ?></h1>
        	  <h2 align='center' id='notExactPlace'><?php echo strtoupper($notExactPlace);?></h2>
		</td>
	</tr>
	<tr>
		<td width="50%"  style="color:black">
			<h1 align='center' id='notExactPlace'>Street View</h1>
		</td>
		<td width="50%">
			<iframe src="http://www.instantstreetview.com/s/<?php echo $exactPlace;?>" width="100%" height="400" style="">
			</iframe>	
		</td>
		
	</tr>
</table>
<script>
function myFunction (pos) {
        var placeIDJS = document.getElementById("placeIDJS").value;
        console.log("Place id : "+placeIDJS);
        var src1 = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyDMceWokpZyVPO4GPgFufYejKD2IJsJA0A&origin=";
        var src3 = "&destination=place_id:"+placeIDJS;
        console.log(pos);
        var src2 = pos.lat+","+ pos.lng;
        console.log(src2);
        var src = src1+src2+src3;
        console.log(src);
        var mapFrame = document.getElementById("mapFrame");
        mapFrame.src = src;
        // mapFrame.style.display = "block";
      }
   
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            // console.log(pos);
            myFunction(pos);
            
            // console.log(pos.lat);
            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        // console.log(pos.lng);
        // console.log(infoWindow);
        // myPos = pos;
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
    </script>
     <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMceWokpZyVPO4GPgFufYejKD2IJsJA0A&callback=initMap">
    </script>
</body>
</html>