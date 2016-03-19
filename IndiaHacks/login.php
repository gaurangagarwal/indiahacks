<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sign Up</title>
<link rel="icon" href="img/pin.png">
<link rel="stylesheet" type="text/css" href="css/normalize.css" />	
<link rel="stylesheet" type="text/css" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="css/set1.css" />
<link rel="stylesheet" type="text/css" href="css/styles.css">
<link rel="stylesheet" type="text/css" href="css/buttonCSS.css">
<link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Chivo:400italic' rel='stylesheet' type='text/css'>
<style type="text/css">
  #message {
    width: 30%;
    height: 35%;

}
</style>

</head>

<script type="text/javascript">
    function validateLogForm() {
      var logEmail = document.getElementById("logEmail").value;
      var logPass = document.getElementById("logPass").value;
      if(logEmail=="" || logPass == "") {
        alert("Please enter valid details in Login");
          return false;
      }
    }
</script>


<body bgcolor="#03a9f4">

<div id="message" align="center"></div>
<?php 
include('includes/header.php');

?>
   
<table width="90%" border="0" bgcolor="#03a9f4" align="center" style="margin-top:3%">
<tr>
    <td width="60%" align="left" height="400px" background="img/world.png" style="background-size:100% 100%; padding-left:10% ">
    <span style="color:#fff; font-size:170%; text-shadow:1px 1px 1px black; text-align:justify"><b>Signing in</b><br>
	Helps you to comment on places <br>
and request others</span>  
    </td>
	<td width="40%">
    <form id="logForm"> 
    
        <table width="90%" style="box-shadow:2px 2px 6px 6px #0288d1;" align="center" border="0" bgcolor="#fff" cellpadding="0" cellspacing="0">
        <tr>
        <td align="center">
        <h3 align="center" style="color:#727272; margin-bottom:0px">FILL YOUR DETAILS BELOW</h3>	
        
        <span class="input input--hoshi" style="margin-bottom:0px; margin-top:0px">
            <input name="logemail" class="input__field input__field--hoshi" type="email" id="logemail" />
            <label class="input__label input__label--hoshi" for="logemail">
                <span class="input__label-content input__label-content--hoshi">Email</span>
            </label>
        </span>
        <span class="input input--hoshi" style="margin-top:0px">
            <input name="logpass" class="input__field input__field--hoshi" type="password" id="logpass" />
            <label class="input__label input__label--hoshi" for="logpass">
                <span class="input__label-content input__label-content--hoshi">Password</span>
            </label>
        </span>
        
        <!--input type="text" name="state" id="signState" value="" style="display:none">
		    <input type="text" name="country" id="signCountry" value="" style="display:none"-->
        <button type="submit" class="ripple" id="logsub" name="logsub" style="background-color:#ffeb3b; color:white; width:100%; padding:10px;border:none;">Submit</button>
        <!-- <input type="submit" id="logsub" name="logsub" style="background-color:#ffeb3b; color:white; width:100%; padding:10px;border:none;"--></td>
        </tr>
        </table>
    </form>

	</td>
</tr>
<?php include('includes/footer.php');?>


<script src="js/classie.js"></script>
<script type="text/javascript">
 $("#logForm").submit( function(e) {
      e.preventDefault();  
      var logemail = document.getElementById("logemail").value;
      var logpass = document.getElementById("logpass").value;
      if(logemail=="" || logpass=="") {
         alert("Please enter valid details in Login");
      } else{
        var data ={
          logemail: logemail,
          logpass: logpass
        };
        
        $.ajax({
          url: 'ajax/logged.php',
          type: 'POST',
          data: data,
        }).success(function(data) {
          // console.log(data);
          if(data == "true") {
            $("#message").text('Logged in');
            showMessage();
            setTimeout(function(){
              window.location.assign("index.php"); 
            }, 1000);
            // setTimeout(funtion (){
            //    window.location.assign("index.php"); 
            // },2000);
          } else {
            $("#message").text('Incorrect Entry');
            showMessage();
            // alert('Incorrect Entry');
          }
        }).fail(function(data) {
            alert("Please Try Again");
        });
      }
  }); 
</script>
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
    <script type="text/javascript" src="js/buttonJS.js"></script>
</body>
</html>
