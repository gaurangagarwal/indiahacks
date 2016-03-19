<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Voyagers | Home</title>
    <link rel="icon" href="img/pin.png">
    <style type="text/css">
    .placeDes1{
       color:#727272;
       background-color:#ffeb3b;
       font-weight:bold;
       font-size:110%;
       box-shadow:0px 0px 10px 2px #727272; 
     }
       .place3, .place2{
       color:white;
       background-color:#03a9f4;
       font-weight:bold;
       font-size:110%;
       box-shadow:0px 0px 10px 2px #727272;
     }
     
     /*#horizontalmenu ul {
        padding:1; margin:1; list-style:none;
      }*/
     /* #horizontalmenu li {
        float:left; position:relative; padding-right:100;
        display:block;
        
      }*/
      #horizontalmenu li ul {
        display:none;
        position:absolute;
        left:50%;
        
      }
      #horizontalmenu li:hover ul{
        display:block;
        height:auto;
      }
      #notificationsForm button{
        color: #727272;
        font-family: 'Product Sans';
        background-color: white;
        cursor: pointer;
        /*background-color: red;*/
      }
      #notificationsForm button:hover{
        /*display: block;*/
      }
      
    </style>
      
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Chivo:400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/hover.css">
  
    <link rel="stylesheet" type="text/css" href="css/buttonCSS.css">
</head>
<body>
<div id="message" align="center"></div>
<?php 
    session_start();

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
      // last request was more than 30 minutes ago
      session_unset();     // unset $_SESSION variable for the run-time 
      session_destroy();   // destroy session data in storage
    }
    $_SESSION['LAST_ACTIVITY'] = time();

    unset($_SESSION['place']);
?>
    
 <script  type="text/javascript">
    
    var placeSearch, autocomplete;
    var componentForm = {
      street_number: 'short_name',
      route: 'long_name',
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      country: 'long_name',
      postal_code: 'short_name'
    };

    function initAutocomplete() {
      // Create the autocomplete object, restricting the search to geographical
      // location types.
      //autocomplete = new google.maps.places.Autocomplete((document.getElementById('txtPlaces')),{types: ['geocode']});
      autocomplete = new google.maps.places.Autocomplete((document.getElementById('txtPlaces')));
      // When the user selects an address from the dropdown, populate the address
      // fields in the form.
      autocomplete.addListener('place_changed', fillInAddress);
    }

    // [START region_fillform]
    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = autocomplete.getPlace();
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          //console.log(val);
          //document.getElementById(addressType).value = val;          
          if(addressType == "country")
            document.getElementById("placeCountryMain").value = val;
          // if(addressType == "administrative_area_level_1")
            // document.getElementById("placeStateMain").value = val;
          if(addressType == "locality")
            document.getElementById("placeStateMain").value = val;  
        }
      }
      document.getElementById("placeIDMain").value = place.place_id;
    } 
    function geolocate() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var geolocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
          };
          var circle = new google.maps.Circle({
            center: geolocation,
            radius: position.coords.accuracy
          });
          autocomplete.setBounds(circle.getBounds());
        });
      }
    }    
    
    // [END region_geolocation]
  
 </script>
<script type="text/javascript">
    
      function validateForm() {
        //  alert("Hello" + place);
        // e.preventDefault();
        if(place == undefined) {
            $("#message").text("Please enter valid location");
            showMessage();
            // alert("Please enter valid location");
            return false;
        } else {
          if(place.place_id == undefined || place.place_id == null) {
              return false;  
          }
          // alert(place.place_id + "   " + place);
          // document.getElementById("placeIDMain").value = place.place_id;
          return true;
        }
      }
      
  </script>
    
    <table border="0" style="background-size:100% 100%;  width:100%; height:93%" cellpadding="20%" background="img/wall.jpg">
    <tr height="10%" valign="top">
    <td colspan="2">
      <span id="voyagersName" style="float:left"><a href="index.php" id="voyagersName" style="font-size:110%">Voyagers</a></span>
        <ul id="horizontalMenu" style="display:inline;">
          <!-- <li style="margin-right:40%;display:inline"></li> -->
          
          <!-- <li style="margin-right:3%; display:inline;">asdasd</li> -->
          <li style="margin-right:3%; float:right; display:inline;  margin-top:2%">
            <a style="display:inline" id="registerBut" href="<?php if(!isset($_SESSION['user'])) echo 'signin.php'; else echo ''; ?>"><?php if(!isset($_SESSION['user'])) echo 'Register'; else echo $_SESSION['user']['name']; ?></a>
          </li>
          <li style="margin-right:3%; float:right; display:inline;   margin-top:2%">
            <a style="font-size:105%" href="<?php if(isset($_SESSION['user'])) echo basename($_SERVER['PHP_SELF']); else echo 'login.php';?>" 
              id="<?php if(isset($_SESSION['user'])) echo 'logoutBut'; else echo 'loginBut';?>" class="logBut" style="font-size:120%"><?php if(isset($_SESSION['user'])) echo 'Log out'; else echo 'Login';?></a>
          </li>
          <li style="margin-right:3%; float:right; display:inline; margin-top:2%"><a href="index.php" id="homeBut">Home</a></li>
          <?php if(isset($_SESSION['user'])) { ?>
          <li style="margin-right:3%; display:inline; float:right;   margin-top:2%">
            <a id="notifications" onclick="notiClick()" style="padding:1%;">Notifications
            </a>
            <ul style="list-style-type:none;">
            <form id="notificationsForm"  action="page.php?unset=true" method="post">
              <?php
                  if(isset($_SESSION['user'])) {   
                    $email = $_SESSION['user']['email'];  
                    $conn = mysqli_connect("localhost","root","", "indiahacks");
                    $sql = "SELECT * FROM userdet WHERE Email = '$email'";
                    $result = mysqli_query($conn,$sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            if($row['ReqLocation1']!=null) 
                                echo"<button type='submit' name='location' class='ripple' value='$row[ReqLocation1]'> $row[ReqLocation1] </button><br>"; 
                            if($row['ReqLocation2']!=null) 
                                echo"<button type='submit' name='location' class='ripple' value='$row[ReqLocation2]'> $row[ReqLocation2] </button><br>"; 
                            if($row['ReqLocation3']!=null) 
                                echo"<button type='submit' name='location' class='ripple' value='$row[ReqLocation3]'> $row[ReqLocation3] </button>"; 
                        }
                    }
                  } else {
                    echo"<li>Log in to see Notifications</li>"; 
                  }
               ?>
               </ul>   
              <input type="text" id="placeID" name="placeID" style="display:none">
              <input type="text" id="placeState" name="placeState" style="display:none">
              <input type="text" id="placeCountry" name="placeCountry" style="display:none">
            </form> 
          </li> 
          
          <?php } ?>

        </ul>

        

    </td>
    </tr>

    <!-- Basics-->
    
    <tr height="60%">
        <td colspan="2" align="center" style="font-size:200%;font-family: 'Product Sans', Arial, sans-serif;">
    <span style=" text-shadow:3px 0px 3px black">Think to travel this summer ?<br>
        <b>We will help you travel !</b></span> 
        <form method="post" id="locSearch" action="page.php" onSubmit="return validateForm()"> 
            <input style="box-shadow:0px 0px 20px 1px black; font-weight:bold; width:35%;" placeholder="Type the name of a location.." type="text" name="location" id="txtPlaces">
            <!--input type="text" id="txtPlaces" name="location" style="width: 500px" placeholder="Enter a location" -->
            <input value="" type="text" id="placeIDMain" name="placeID" style="display:none">
            <input value="" type="text" id="placeStateMain" name="placeState" style="display:none">
            <input value="" type="text" id="placeCountryMain" name="placeCountry" style="display:none">
            <!-- <button class="ripple" type="submit" id="searchSub">Search</button>             -->
            <button class="ripple" id="searchSub">Search</button>            
            <!-- <input type="submit" id="searchSub" value="Search"> -->
        </form>
        
        </td>
    </tr>
    <tr height="30%" style="padding-bottom:0px">
      <td colspan="2" align="center" style="font-size:180%; color:white">
        <a href="#discover" style="color:white" class="smoothScroll">
          <span style="text-shadow:2px 2px 2px black">Discover</span><br>
          <img src="img/button.png" width="5%" class="hvr-grow">
        </a>
      </td>
    </tr>
    </table>
    
   <h1 name="discover" style="color:#727272; padding:1%; font-size:120%" align="center">CHECK OUT SOME OF THE MOST LOVED PLACES</h1> 
    
<table align="center" cellspacing="0"  width="65%">
  <tr height="270px" id="place1" background="img/amberFort.JPG" style="background-size:100% 100%; cursor:pointer;">
        <td colspan="3" align="center" style="box-shadow:0px 0px 10px 2px #727272;"></td>
  </tr>
  <tr>
    <td colspan="3" class="placeDes1" align="center" height="60" style="">Amber Fort, Amer, Jaipur, Rajasthan</td>
  </tr>
  <tr height="20"><td></td>
  </tr>        
        <tr>
            <td class="place2" width="40%" height="200px" background="img/theRidge.jpg" style="background-size:100% 100%;  box-shadow:0px 0px 10px 2px #727272;cursor:pointer;"></td>
            <td width="5%"></td>
            <td  class="place3" background="img/rockGarden.jpg" style="background-size:100% 100%; box-shadow:0px 0px 10px 2px #727272;cursor:pointer;"></td>
        </tr>
        <tr>
        <td  class="place2" style="cursor:pointer;" height="60" align="center">Mall Road, Shimla, Himachal Pradesh</td>
        <td></td>
        <td  class="place3" style="cursor:pointer;" height="60" align="center">Rock Garden Chandigarh</td>
        </tr>
    </table>
    
    <?php include('includes/footer.php');?>
    <form id="trialLocForm"  method="post" action="page.php">
        <input type="text" id="trialLocation" name="location" style="display:none">
        <input type="text" id="trialPlaceID" name="placeID" style="display:none">
        <input type="text" id="trialPlaceState" name="placeState" style="display:none">
        <input type="text" value="India" id="trialplaceCountry" name="placeCountry" style="display:none">
    </form>
    <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="js/myscript.js"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMceWokpZyVPO4GPgFufYejKD2IJsJA0A&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>


  
    <script type="text/javascript">
       $("#place1").click(function(){
        $("#trialLocation").val("Amer Fort, Amer, Jaipur, Rajasthan, India");
      $("#trialPlaceID").val("ChIJ-w3Sy1qwbTkRK34UR2ffIWI");
          $("#trialPlaceState").val("Jaipur");
      
          $("#trialLocForm").submit();      
      }); 
    $(".place2").click(function(){
        $("#trialLocation").val("Mall Road, Bemloi, Shimla, Himachal Pradesh, India");
      $("#trialPlaceID").val("ChIJG1usnet4BTkRzQqb_Ys-JOg");
          $("#trialPlaceState").val("Shimla");
      
          $("#trialLocForm").submit();      
      });
    $(".place3").click(function(){
        $("#trialLocation").val("Rock Garden, Chandigarh, India");
      $("#trialPlaceID").val("ChIJHd27EkTtDzkRpTq5mNfGk2M");
          $("#trialPlaceState").val("Chandigarh");
      //alert($('#txtPlaces').val());
          $("#trialLocForm").submit();      
      });
    </script>  
    <script type="text/javascript" src="js/buttonJS.js"></script>   
    <script type="text/javascript" src="js/smoothscroll.js"></script>

    <script type="text/javascript">
    var notificationsBtn = document.getElementById("notifications");
    notificationsBtn.onmouseover = function () {
      // document.getElementById("")
    };

    </script>
    <!--script type="text/javascript">
    $("#logoutBut").on('click', function(e){
        //e.preventDefault();   
        $.ajax({
           url: 'ajax/logout.php',  
           type:'GET', 
        }).success(function(data){
            //$("message").slideDown();
            location.reload();
            //alert('Logged out');
        }).fail(function(data){
            alert('Please try again');
        }); 
    });
    </script-->
</body>
</html>