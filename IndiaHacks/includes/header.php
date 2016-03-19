
<style type="text/css">
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


<?php 
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
?>














 <table border="0" id="frontTable" cellpadding="20" bgcolor="#0288d1">
    <tr height="10%" valign="top">
    <td width="35%" align="left"><a href="index.php" id="voyagersName">Voyagers</a></td>	
    <td style="width:65%;" valign="top" align="right">
   	<table style="padding:8px" border="0" width="<?php if(isset($_SESSION['user'])) echo '100'; else echo '30'?>%" align="right">
        
        <tr>
        
        <?php
            if(isset($_SESSION['user'])) {
        ?>
        <td width="45%" align="right">
        <form action="page.php?unset=true" id="notiForm" method="post" style="display:none">
            <select name="location" onchange="this.form.submit(); ">
            	<option>Select Place</option>
                <?php		
                $email = $_SESSION['user']['email'];	
                $conn = mysqli_connect("localhost","root","", "indiahacks");
                $sql = "SELECT * FROM userdet WHERE Email = '$email'";
                $result = mysqli_query($conn,$sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['ReqLocation1']!=null) 
                            echo"<option> $row[ReqLocation1] </option>"; 
                        if($row['ReqLocation2']!=null) 
                            echo"<option> $row[ReqLocation2] </option>"; 
                        if($row['ReqLocation3']!=null) 
                            echo"<option> $row[ReqLocation3] </option>"; 
                    }
                }
                ?>
            </select>
            <input type="text" id="placeID" name="placeID" style="display:none">
            <input type="text" id="placeState" name="placeState" style="display:none">
            <input type="text" id="placeCountry" name="placeCountry" style="display:none">
            <input type="text" id="placeUrl1" name="placeUrl1" style="display:none">
            <input type="text" id="placeUrl2" name="placeUrl2" style="display:none">
        </form>
        </td>
        <td></td>
        <td style="width:auto" align="center">
        	<a id="notifications" onclick="notiClick()">Notifications</a>
        </td>
        <td></td>
        <?php
        }?>	
        <td width="7%"><a href="index.php" id="homeBut">Home</a></td>
        <td></td>
        <td style="width:8%" align="center">

        <a style="font-size:105%" href="<?php if(isset($_SESSION['user'])) echo basename($_SERVER['PHP_SELF']); else echo 'login.php';?>" 
            id="<?php if(isset($_SESSION['user'])) echo 'logoutBut'; else echo 'loginBut';?>" class="logBut" style="font-size:120%"><?php if(isset($_SESSION['user'])) echo 'Log out'; else echo 'Login';?></a>		
        </td>
        <td></td>
        <td style="width:auto" align="center">
            <a id="registerBut" href="<?php if(!isset($_SESSION['user'])) echo 'signin.php'; else echo ''; ?>"><?php if(!isset($_SESSION['user'])) echo 'Register'; else echo ucfirst($_SESSION['user']['name']); ?></a></td>
    	</td>
        </tr>
    </table> 
    </tr>
   
</table>

<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="js/myscript.js"></script>
<script type="text/javascript" src="js/locationSearch.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMceWokpZyVPO4GPgFufYejKD2IJsJA0A&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
