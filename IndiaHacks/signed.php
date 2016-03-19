<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Voyagers | Signed </title>
<link rel="icon" href="img/pin.png">
 <link rel="stylesheet" type="text/css" href="css/styles.css">
 <link rel="stylesheet" type="text/css" href="css/buttonCSS.css">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Chivo:400italic' rel='stylesheet' type='text/css'>
</head>

<body bgcolor="#03a9f5"> 

<table border="0" id="frontTable" cellpadding="20" bgcolor="#0288d1">
    <tr height="10%" valign="top">
	    <td width="45%" align="left"><a href="index.php" id="voyagersName">Voyagers</a></td>	
	    <td style="width:55%;" valign="top" align="right"></td>
    </tr>
</table>
<?php
	session_start();
	$createID = true;
	$conn = mysqli_connect("localhost","root","","indiahacks");
	$sql = "SELECT * FROM userdet";
	$result = mysqli_query($conn,$sql);
	 if(mysqli_num_rows($result) >0 ) {
      while($row = mysqli_fetch_assoc($result)) {
        if($row['Email'] == $_POST['email']) {         
        // if($row['Email'] == "subh@g.com") {         
          echo "<h2>This email already Exist</h2>";
          $createID = false;
          break;
        }  
      }
    }
    
    if($createID == true) {
    	$storePass = password_hash(mysql_real_escape_string($_POST['password']) , 
    		PASSWORD_BCRYPT, array('cost' => 10));	
   	
		$sql = "INSERT INTO userdet (Name, Password, Age, Email, State, Country)
		VALUES ('$_POST[name]','$storePass', '$_POST[age]', '$_POST[email]', '$_POST[state]', '$_POST[country]')";
		
		if (mysqli_query($conn, $sql)) {
		    $_SESSION['user']['email'] = $_POST['email'];
			$_SESSION['user']['pass'] = $_POST['password'];
			$_SESSION['user']['name'] = $_POST['name'];
			$_SESSION['user']['state'] = $_POST['state'];
			$_SESSION['user']['country'] = $_POST['country'];
		    //echo "New record created successfully";
		    $_SESSION['LAST_ACTIVITY'] = time();
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		$email = $_POST['email'];
?>
</span>
<h3>Your Account has been successfully created </h3>
<h2 style="font-family:aclonica">Welcome
<?php 
echo ucFirst($_POST['name']);
?>
</h2>
<?php }?>

<form action="<?php if($createID == true) echo 'index.php'; else echo 'signin.php' ?>" method="post">
	<button id="requestBut" class="ripple submitCom" type="submit" name="checkSub">Go to <?php if($createID == true) echo 'Home page'; else echo 'Signin page' ?>
	</button>
	<!-- <input id="requestBut" type="submit" name="checkSub" value="Go to <?php if($createID == true) echo 'Home page'; else echo 'Signin page' ?>"> -->
</form>	

<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="js/buttonJS.js"></script>
</body>
</html>