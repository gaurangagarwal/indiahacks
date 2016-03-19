<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Voyagers | Sign in</title>
<link rel="icon" href="img/pin.png">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />	
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/set1.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/buttonCSS.css">
<link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Chivo:400italic' rel='stylesheet' type='text/css'>
</head>

<script type="text/javascript">
    var place = null;
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
     
      autocomplete = new google.maps.places.Autocomplete((document.getElementById('signAddress')));

      autocomplete.addListener('place_changed', fillInAddress);
    }

    // [START region_fillform]
    function fillInAddress() {
      // Get the place details from the autocomplete object.
      place = autocomplete.getPlace();
      //console.log(place.place_id);
      var stateDone =0;
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          
          var val = place.address_components[i][componentForm[addressType]];
          if(addressType == "country")
            document.getElementById("signCountry").value = val;
          
          if(addressType == "locality" )
            document.getElementById("signState").value = val;
        }
      }
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
    
</script>
 
<script type="text/javascript">
  function validateSignForm() {
      //console.log("Here we come sigj Dofmr");
      //alert("Here we come sigj Dofmr");
      var signName = document.getElementById("signName").value;
      var signPass = document.getElementById("signPass").value;
      var signAge = document.getElementById("signAge").value;
      var signEmail = document.getElementById("signEmail").value;
      
      if(signName== "" || signPass== "" ||signAge== "" ||signEmail== "" || place == undefined) {
        alert("Please enter valid details in SignUp")
        return false;
     } 
  }
</script>




<body bgcolor="#03a9f4">
<div id="message" align="center"></div>

<table border="0" id="frontTable" cellpadding="20" bgcolor="#0288d1">
    <tr height="10%" valign="top">
      <td width="35%" align="left"><a href="index.php" id="voyagersName">Voyagers</a></td>  
      
      <td style="width:45%;" valign="top" align="right">
      </td>
      <td style="width:5%;" valign="top" align="right">
        <a href="index.php" id="homeBut">Home</a></td>
        <td>|</td>
      <td style="width:5%;" valign="top" align="right">
        <a href="login.php" id="homeBut">Login</a>
      </td>
      <td>|</td>
      <td style="width:20%;" valign="top" align="right">
        <a id="registerBut">Sign in</a>
      </td>
    </tr>
</table>

<?php 
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
?>



<?php 
//include('includes/header.php');
?>
   
<table width="90%" border="0" bgcolor="#03a9f4" align="center" style="margin-top:3%">
<tr>
    <td align="left" width="60%" background="img/world.png" style="background-size:100% 100%; padding-left:10% ">
    <span style="color:white; font-size:170%; text-shadow:0.5px 0.5px 0.5px black; text-align:left"><b>Signing in</b><br>
	Helps you to comment on places <br>
and request others</span>  
    </td>
	<td width="40%">
    <form method="post" action="signed.php" onsubmit="return validateSignForm()">
    
        <table width="90%" style="box-shadow:2px 2px 6px 6px #0288d1;" align="center" border="0" bgcolor="#fff" cellpadding="0" cellspacing="0">
        <tr>
        <td align="center">
        <h3 align="center" style="color:#727272; margin-bottom:0px">FILL YOUR DETAILS BELOW</h3>	
        <span class="input input--hoshi" style="margin-bottom:0px; margin-top:0px">
            <input name="name" value="" class="input__field input__field--hoshi" type="text" id="signName" />
            <label class="input__label input__label--hoshi" for="signName">
                <span class="input__label-content input__label-content--hoshi">Name</span>
            </label>
            
        </span>
        <span class="input input--hoshi" style="margin-bottom:0px; margin-top:0px">
            <input  name="age" value="" class="input__field input__field--hoshi" type="number" id="signAge" />
            <label class="input__label input__label--hoshi" for="signAge">
                <span class="input__label-content input__label-content--hoshi">Age</span>
            </label>
        </span>
        <span class="input input--hoshi" style="margin-bottom:0px; margin-top:0px">
            <input name="email" value="" class="input__field input__field--hoshi" type="email" id="signEmail" />
            <label class="input__label input__label--hoshi" for="signEmail">
                <span class="input__label-content input__label-content--hoshi">Email</span>
            </label>
        </span>
        <span class="input input--hoshi" style=" margin-top:0px; margin-bottom:0px;">
            <input placeholder="" value="" name="address" id="signAddress" class="input__field input__field--hoshi" type="text" />
            <label class="input__label input__label--hoshi" for="signAddress">
                <span class="input__label-content input__label-content--hoshi">Address</span>
            </label>
        </span>
        <span class="input input--hoshi" style="margin-top:0px">
            <input name="password" value="" class="input__field input__field--hoshi" type="password" id="signPass" />
            <label class="input__label input__label--hoshi" for="signPass">
                <span class="input__label-content input__label-content--hoshi">Password</span>
            </label>
        </span>
        
        
        <input type="text" name="state" id="signState" value="" style="display:none">
		    <input type="text" name="country" id="signCountry" value="" style="display:none">
        <button class="ripple" type="submit" style="background-color:#ffeb3b; color:#212121; font-size:110%; width:100%; padding:20px;border:none;">Submit</button>
        <!-- <input type="submit" style="background-color:#ffeb3b; color:#212121; font-size:110%; width:100%; padding:20px;border:none;"-->
        </td>
        </tr>
        </table>
    </form>
	</td>
</tr>
</table>
<?php include('includes/footer.php');?>


<script src="js/classie.js"></script>

		<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
			 		(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script>
       
       
 <script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
 <script type="text/javascript" src="js/myscript.js"></script>
 <script type="text/javascript" src="js/buttonJS.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMceWokpZyVPO4GPgFufYejKD2IJsJA0A&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>


</body>
</html>
