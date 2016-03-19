<html>
<head>
<title>Voyagers | Location</title>
  <link rel="icon" href="img/pin.png">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Chivo:400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="css/myLightBox.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/set1.css" /> -->
</head>
<body >    
   <div id="message" align="center"></div>
   <?php 
    include('includes/header.php');

    $conn = mysqli_connect("localhost","root","","indiahacks");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    } 
    

    if(isset($_GET['unset']) && $_GET['unset'] == true) {
      echo $_POST['location'];
      $selectSql = "SELECT * FROM places WHERE PlaceName = '$_POST[location]'";
      $selectQuery = mysqli_query($conn, $selectSql);
      $row = mysqli_fetch_assoc($selectQuery);
      // echo $row['PlaceState'];
      // echo "Hello world";
      unset($_SESSION['place']);
      $_SESSION['place']['placeID'] = $row['PlaceID'];
      $_SESSION['place']['location'] = $row['PlaceName'];
      $_SESSION['place']['placeState'] = $row['PlaceState'];
      $_SESSION['place']['placeCountry'] = $row['PlaceCountry'];
    }
  //echo $_POST['placeUrl'];
  if(!isset($_SESSION['place'])) {
    $postPlaceID = $_POST['placeID'];
    $postPlaceState = $_POST['placeState'];
    $postPlaceCountry = $_POST['placeCountry'];

    $postLocation = $_POST['location'];
  } else {
    $postPlaceID = $_SESSION['place']['placeID'];
    $postPlaceState = $_SESSION['place']['placeState'];
    $postPlaceCountry = $_SESSION['place']['placeCountry'];  
    $postLocation = $_SESSION['place']['location']; 
  }
  // echo "<h1 style='color:black'>Theplac e id : ".$postPlaceID."</h1>";
  // echo "State : ".$postPlaceState;
  // echo "Country : ".$postPlaceCountry;

   // if(!isset($_SESSION['place']))
   //   echo "Not set ".$postPlaceState. $postPlaceID;
   // else
   //   echo "Setted".$postPlaceState;
    
  if(isset($_GET['unset']) && $_GET['unset'] == true) {
    
    $postEmail = $_SESSION['user']['email'];
    $findReqSql = "SELECT * FROM userdet WHERE Email = '$postEmail'";
    $findReqQuery = mysqli_query($conn, $findReqSql);
    if(!$findReqQuery)
      echo mysqli_error($conn);
    $reqs = mysqli_fetch_assoc($findReqQuery);

    for ($i=1; $i <=3; $i++) {
      $colName = 'ReqLocation'.$i;
      //echo $colName;
      if($reqs[$colName] == $postLocation) {
        $upReqSql = "UPDATE userdet SET $colName = NULL WHERE Email = '$postEmail'";
        $upReqQuery = mysqli_query($conn, $upReqSql); 
        //echo $upReqSql;
        if( !$upReqQuery)
          echo mysqli_error($conn);
      } 
    }
  }


  //echo "Url : ".$postPlaceUrl."<br>"; 
  
  
  $_SESSION['place']['placeState'] = $postPlaceState;
  $_SESSION['place']['placeCountry'] = $postPlaceCountry;
  $_SESSION['place']['placeID'] = $postPlaceID;
  $_SESSION['place']['location'] = $postLocation;
   
  
   
    //$sql = "SELECT * FROM places";    

   // $result = mysqli_query($conn, $sql);
    //$numberOfCol =  mysqli_num_fields($result);
   
    //echo $result;
    echo "<br>";
    $findLoc = false;
    $placeKey = 0; 
    $placeQuery = mysqli_query($conn , "SELECT *  FROM places WHERE PlaceID = '$postPlaceID'");
    //echo $placeQuery;
    if(!$placeQuery)
      echo mysqli_query($placeQuery);

    if (mysqli_num_rows($placeQuery) > 0) {   // find if place name exist 
        while($row = mysqli_fetch_assoc($placeQuery)) {
            //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
            //echo " Place ID : ".$row['PlaceID']. " Place Name : ".$row['PlaceName'].$row['do']. $row['by']."<br>";
            $placeKey  = $row['ID'];
            $findLoc = true;
            break;
        }
    }
    if($postPlaceID != "" && $postLocation != "") { 
      if($findLoc == false) {  // if doesnt exist (placename) insert in places table
        $insertPlace = "INSERT INTO places (PlaceID, PlaceName) VALUES ('$postPlaceID', '$postLocation')";
        $insertPlaceQuery = mysqli_query($conn, $insertPlace); 
        if(!$insertPlaceQuery) {
          echo mysqli_error($insertPlaceQuery);
        }
      }
    }

   $commPos =  strpos($postLocation, ',');
   $exactPlace = substr($postLocation, 0,$commPos);
   $notExactPlace = substr($postLocation, $commPos+1);
   ?>
   
   
     <table id='headingBack' border="0">
      <tr>
        <td width="40%" valign="middle">
          <h1 align='center' id='exactPlace' ><?php echo $exactPlace; ?></h1>
          <h2 align='center' id='notExactPlace'><?php echo strtoupper($notExactPlace);?></h2>
        </td>
        <td width="auto">
        </td>
        <td width="13%"  valign="middle" align="center">
          <a href="live.php" target="_blank">
            <img src="img/photosphere.png" width="70%" >
          </a>
        </td>
        <td width="13%"  valign="middle"  align="center">
          <a href="live.php" target="_blank">
            <img src="img/blip.png" width="65%">
          </a>
        </td>
        <td width="3%">
        </td>
      </tr>
     </table>

   <table border="0" width="70%" cellspacing="0" style="position:relative; left:15%; margin-top:11%; box-shadow: 0px 0px 10px #888888; ">
     <tr align="center" valign="middle">
      <th width="50%" style="background-color:#ffeb3b; color: #0288d1; font-size:150%; padding:1% 0% 1% 0%">DOs</th>
      <th width="50%" style="background-color:#ffeb3b; color: #0288d1; font-size:150%; padding:1% 0% 1% 0%">DON'Ts</th>
     </tr>
   <tr valign="top">
      <td style="background-color:white; color:#727272; padding: 1%;border-right:2px solid #ccc">

   <?php
   
   if($findLoc == false) {
    echo "No comments found";
   } else {/* 
      $sql = "SELECT places.PlaceID , places.PlaceName,  dodata.do, dodata.by
      FROM (SELECT * FROM places WHERE places.PlaceName = '$postLocation') as places
      INNER JOIN dodata ON places.ID = dodata.PlaceKey
      WHERE places.ID = dodata.PlaceKey";*/
     
      $sql = "SELECT * FROM dodata WHERE PlaceKey = $placeKey";
      //echo $sql;
      $dataQuery = mysqli_query($conn, $sql);
      
      while($row = mysqli_fetch_assoc($dataQuery)) {     
          $len = strlen($row['comm']);
          //echo $len;
          $postByName = substr($row['comm'] , 0, $len-9); 
          $postByDate = substr($row['comm'] , $len-9, 9);
          //if($row['by'] !=null) 
          
          echo "<li class='comments'><strong style='font-size:120%'>\"".ucfirst($row['head'])."\"</strong><br>";
          echo  "<span style='text-align:right'>Posted by <strong>".$postByName."</strong> on ".$postByDate."<span><br>";
          echo ucfirst($row['do'])."</li>";
          echo "<img src='img/unlike.png' data-type='do' data-id='".$row['doID']."' width='25' onclick='increaseLike(this)'>  "
              ."<span id='noOfLikes' class='noOfLikes'>Upvotes : ".$row['likes']."&nbsp;&nbsp;&nbsp;</span><br>";

      }
  }
?>


  </td>
  
  <td style="background-color:white; color:#727272;  padding: 1%; ">
<?php
  
      $sql = "SELECT * FROM dontdata WHERE PlaceKey = $placeKey";
      //echo $sql;
      $dataQuery = mysqli_query($conn, $sql);
    
     
     //------------Donts Print ------------------------------
     if($findLoc == false) {
      echo "No comments found";
     } else {
      while($row = mysqli_fetch_assoc($dataQuery)) {     
          $len = strlen($row['comm']);

          $postByName = substr($row['comm'] , 0, $len-9); 
          $postByDate = substr($row['comm'] , $len-9, 9);
          //if($row['by'] !=null) 
          echo "<li class='comments'><strong>\"".ucfirst($row['head'])."\"</strong><br>";
          echo  "<span>Posted by <strong>".$postByName."</strong> on ".$postByDate."<span><br>";
          echo ucfirst($row['dont'])."</li>";
          echo "<img src='img/unlike.png' data-type='dont' data-id='".$row['dontID']."' width='25' onclick='increaseLike(this)'>";
          echo "<span class='noOfLikes' id='noOfDontLikes'>Upvotes : ".$row['likes']."&nbsp;&nbsp;&nbsp;</span><br>";
      }
    }

          
  
?>
   
 
<?php
// input submission in php
  // echo $_POST['commSubmitBtn']; 
  if(isset($_POST['commSubmitBtn'])) {
    // echo "sdcvs csekchbsdc skdcbs dvcksdhbvsdv vd sd ";
    // do entry
    if( $_POST['userDo']!= "" && $_POST['userDoHead']!="" ) {    
      $userName = $_SESSION['user']['name'];
      $Comm = $userName.(date('d M,y'));
      $doComm = mysql_real_escape_string(trim($_POST['userDo']));
      $doHead = mysql_real_escape_string(trim($_POST['userDoHead']));
      $searchSql= "SELECT * FROM dodata WHERE PlaceKey = $placeKey and do ='$doComm' and head='$doHead' ";
      $searchQuery = mysqli_query($conn, $searchSql);
      $repeat = false; 
      if(!$searchQuery) {
        echo mysqli_error($conn);
      } 
      if(mysqli_num_rows($searchQuery) > 0)
        $repeat = true;
      if($repeat == false) {
        $insertComm = "INSERT INTO dodata (PlaceKey, do, head , Comm) VALUES ($placeKey, '$doComm', '$doHead' ,'$Comm' )";
        $insertCommQuery =  mysqli_query($conn , $insertComm);
        // if(!$insertComm)
        //   echo mysqli_error($insertComm);
      }
      // end of add entry
    }
    // dont entry  
    if($_POST['userDont'] !=="" && $_POST['userDontHead']!="")   {
      // echo "heloasd";
      $userName = $_SESSION['user']['name'];
      $Comm = $userName.(date('d M,y'));
      $dontComm =  mysql_real_escape_string(trim($_POST['userDont']));
      $dontHead =  mysql_real_escape_string(trim($_POST['userDontHead']));
      $searchSql= "SELECT * FROM dontdata WHERE PlaceKey = $placeKey and dont ='$dontComm' and head='$dontHead' ";
      // echo $searchSql;
      $searchQuery = mysqli_query($conn, $searchSql);
      // echo $searchQuery;
      $repeat = false; 
      // echo mysqli_num_rows($searchQuery); 
      if(mysqli_num_rows($searchQuery) >0) {
          echo "true";
          $repeat = true;
      }
      if($repeat==false) {
        // echo "false";
        $insertComm = "INSERT INTO dontdata (PlaceKey, dont, head , Comm) VALUES ( $placeKey ,'$dontComm','$dontHead','$Comm' )";
        // echo $insertComm;
        $insertCommQuery =  mysqli_query($conn , $insertComm);
        if(!$insertCommQuery)
          echo mysqli_error($conn);
      }
    }
  }
  if(isset($_POST['userAppSubmitBtn'])) {
    // echo "Helaoasc";
     if($_POST['userAppHead']!="" && $_POST['userAppDesc']!="") {
        $userName = $_SESSION['user']['name'];
        // echo "Helaoasc";
        $Comm = $userName.(date('d M,y'));
        $appHead =  mysql_real_escape_string(trim($_POST['userAppHead']));
        $appDesc =  mysql_real_escape_string(trim($_POST['userAppDesc']));
        $appLink =  mysql_real_escape_string(trim($_POST['userAppLink']));
        $searchSql= "SELECT * FROM appdata WHERE PlaceKey = '$postPlaceID' and appLink='$appLink' ";
        $searchQuery = mysqli_query($conn, $searchSql);
        $repeat = false; 
        if(mysqli_num_rows($searchQuery) >0)
          $repeat = true;
        if($repeat==false) {
        $insertComm = "INSERT INTO appdata (PlaceKey, appName, appLink , appDesc, comm) VALUES ('$postPlaceID' ,'$appHead','$appLink','$appDesc', '$Comm' )";
        $insertCommQuery =  mysqli_query($conn , $insertComm);
        // if(!$insertComm)
        //   echo mysqli_error($insertComm);
        }   
     }  
  }
?>
   
       
   </td> 
   </tr>
   </table>


   <table border="0" width="70%" align="center" style="position:relative">
    <tr>
      <td colspan="3" style="padding:2%">
      <div style="display:inline; margin-right:66%" > 
        <?php
        // Add review Button
        if(isset($_POST['userSubDo']))  // user has submitted the form
            echo "<h3 id='doThanks'>Thanks</h3>";
        else { 
            if(isset($_SESSION['user'])) {  // user is logged in
        ?>  
            <button class="submitCom" id='writeReviewBtn'>ADD A REVIEW</button>
              <!-- <a class="submitCom" href='#' id='writeReviewBtn'>Add a review</a> -->
        <?php 
            } else {
              // echo "<span style='color:black'>Sign in to Write a comment</span><br>";
              echo "<a class='submitCom' href='login.php'>Login</a>";
            }
        } 
          ?>
      </div>

      <div style="display:inline">
          <?php
          // request Button
        if(!isset($_GET['unset'])) {
          if(isset($_SESSION['user'])) {
           ?>
           <a id="requestBut"  class="submitCom">SEND A REQUEST</a>
              <!-- <button type="submit" id='requestBut' disabled style="background-color:#ccc;">Your request is sent</button> -->
            <?php
          } else {?>
            <button type="submit" class="submitCom" disabled style="background-color:#ccc; color:black">Sign in to request Others</button>
          <?php
          } 
        }
          ?> 
      </div>
     </td>
    </tr>
  </table>

  <table width="70%" cellspacing="0" style="position:relative; left:15%; box-shadow:0px 0px 8px #888">
    <tr>
      <td width="100%" align="center" style="background-color:#ffeb3b; color: #0288d1; font-weight:bold; font-size:150%; padding:1% 0% 1% 0%">
          OTHER COOL STUFF TO CHECK OUT
      </td>
    </tr>
    <tr> 
      <td style="color:black">
      <?php
        $appSql = "SELECT * FROM appdata WHERE PlaceKey = '$postPlaceID'";
        $appResult = mysqli_query($conn, $appSql);
        if(mysqli_num_rows($appResult)) {
          echo "<ul style='list-style-type: none;'>";
          while ($row = mysqli_fetch_assoc($appResult)) {
              $len = strlen($row['comm']);
              $postByName = substr($row['comm'] , 0, $len-9); 
              $postByDate = substr($row['comm'] , $len-9, 9);

              echo "<a style='color:#727272' target='_blank' href= '".$row['appLink']."'>";    
              echo "<h1 >".$row['appName']."</h1>";
              echo  "<span style='text-align:right; color:#727272'>Posted by <strong>".$postByName."</strong> on ".$postByDate."<br>";
              echo "<span>".$row['appDesc']."</a><br>";
              echo "<img src='img/unlike.png' data-type='app' data-id='".$row['appID']."' width='25' onclick='increaseLike(this)'>  "
              ."<span style='color:#727272; float:left' id='noOfLikes'>Upvotes : ".$row['likes']."&nbsp;&nbsp;&nbsp;&nbsp;</span>"."<br>";
          }
          echo "</ul>";
        }
      ?>
      </td>
    </tr>
  <tr>
  <td style="padding-bottom:1%">
  <div style="color:black; margin-bottom:20px; margin-right:3%">
  <?php
        // Add app Button
    if(isset($_POST['appSubmitBtn']))  // user has submitted the form
        echo "<h3 id='doThanks'>Thanks</h3>";
    else { 
        if(isset($_SESSION['user'])) {  // user is logged in
    ?>  
          <div align="right" style=" margin-top:1%;">
            <button class="ripple submitCom" id="addAppBlog" style="float:right;" >ADD App/Blog</button> 
          </div>
          <!-- <a class="submitCom" href='#' id='writeReviewBtn'>Add a review</a> -->
    <?php 
        } 
    } 
      ?>
      </td>
   </div>   
</table>
  <!-- <div align="right" style="margin-right:15%; margin-top:1%">
    <button class="ripple submitCom" id="addAppBlog" >ADD App/Blog</button> 
  </div> -->


<!-- <table border="0" align="center" width="80%" height="400" style="background-image:url(img/2.jpg); background-size:100% 100%; position:absolute; left:10%; bottom:-100px; z-index:-2;">
  <tr>
    <td></td>
  </tr>
  <tr>
  </tr>
</table> -->

<table cellpadding="20" bgcolor="#e4e3e3" width="100%" style="margin-top:2%; position:relative; bottom:0px;">
<tr>
<td><span id="voyagersName" style="color:#928888; text-shadow:none;">Voyagers</span></td>
<td></td>
</table>

<!-- Light Box for do and don't-->
<div class="modal" style="color:black;">
    <div class="modal-container">
    <!-- <span ><img src="img/close.gif"></span> -->
      <form method="post" action="page.php">
        <table border="0" cellspacing="0" cellpadding="10" style="margin-top:2%" align="center" width="100%" height="85%">
          <tr height="15%">
            <td rowspan="2" width="8%" class="donDontLightBoxHead" style=";">Do</td>
            <td class="reviewHeadTd"><input type="text" name="userDoHead" class="reviewHeadInputDo" placeholder="Heading of the review"></td>  
          </tr>
          <tr>
            <td class="reviewDescTd"><textarea placeholder="Despription" name="userDo" class="reviewDescInputDo"></textarea> </td>
          </tr>
          <tr height="5%">
            <td></td>
          </tr>
          <tr style="background-color:#0288d1">
            <td rowspan="2" class="donDontLightBoxHead" style="color:white">Dont</td>
            <td class="reviewHeadTd"><input type="text" name="userDontHead" class="reviewHeadInputDont" placeholder="Heading of the review"></td>  
          </tr>
          <tr  style="background-color:#0288d1">
          <td class="reviewDescTd"><textarea class="reviewDescInputDont" name="userDont" placeholder="Despription"></textarea> </td>
          </tr>
        </table>
        <input style="margin-top:2%;margin-left:3%; width:15%;color:black; background-color:#ffeb3b" type="submit" value="Submit" id="commSubmitBtn" class="ripple submitCom" name="commSubmitBtn">
        <span id="closeBtn" class="ripple submitCom">Close</span>
        <!-- <button>Close</button> -->
      </form>
    </div>
 </div>


<!-- light box for App and blog --> 
<div class="modalApp" style="color:black;">
    <div class="modalApp-container">
    <!-- <h1 style="margin:0px">App, Blog, etc.</h1> -->
    <!-- <span id="closeBtnApp"><img src="img/close.gif"></span> -->
      <form method="post" action="page.php" onsubmit="">
        <table border="0" style="color:black; margin-top:2%" align="center" width="85%" height="85%">
          <tr>
            <td class="reviewHeadTd"><input type="text" name="userAppHead" class="reviewHeadInputDo" placeholder="Heading of the review"></td>  
          </tr>
          <tr>
            <td><input type="text" placeholder="Link" class="appLink reviewHeadInputDo" name="userAppLink"></td>
          </tr>
          <tr height="60%">
            <td class="reviewDescTd"><textarea placeholder="Despription" name="userAppDesc" class="reviewDescInputDo"></textarea> </td>
          </tr>
        </table>
        <span id="closeBtnApp" class="submitCom">Close</span>
        <input style="margin-top:2%;margin-left:3%; width:15%;color:black; background-color:#ffeb3b" type="submit" class="submitCom" id="appSubmitBtn" name="userAppSubmitBtn" value="Submit">
      </form>
    </div>
 </div>

<script src="js/jquery-2.2.0.min.js"></script>

<script type="text/javascript">
// start light box  
  $("#writeReviewBtn").click(function () {
    $(".modal").fadeIn();
  });
  // close light box
  $("#closeBtn").click(function () {
    $(".modal").fadeOut();
  });
  $("#addAppBlog").click(function () {
    $(".modalApp").fadeIn();
  });
  // close light box
  $("#closeBtnApp").click(function () {
    $(".modalApp").fadeOut();
  });

</script>


<script type="text/javascript">
  // on click of like button
  function increaseLike(self) {
    // console.log(self.getAttribute("data-type"));
    // console.log(self.getAttribute("data-id"));
  // $(".likeBtn").on('click', function(e){
  //  if(requestSent == false) { 
    var data = {
      type : self.getAttribute("data-type"),
      id : self.getAttribute("data-id")
    };
    // $pieces = explode("//", self.src);
    // console.log($pieces);
    // if(self.src == "img/unlike.png") {
      // e.preventDefault();  
      $.ajax({
         url: 'ajax/likeSend.php',  
         type:'POST',
         data: data,
      }).success(function(data){
         // console.log(data);
         $("#message").text("Thanks for voting");
         showMessage();
         self.src = "img/like.png";
      }).fail(function(data){
          $("#message").text("Please try Again");
          showMessage();
      });  
    // }
  }

</script>


 <script type="text/javascript">
 var requestSent = false;

  // Send request button
    $("#requestBut").on('click', function(e){
        // alert("asda");
        if(requestSent == false) {
          // alert("habsdasd"); 
          e.preventDefault();  
          $.ajax({
             url: 'ajax/requestSend.php',  
             type:'GET', 
          }).success(function(data){
             $("#message").text("Request Sent");
             showMessage();
             // alert('success');
             $("#requestBut").text("Request Sent");
             // console.log(data);
             requestSent = true;
             //var requestDone = true;
             //$("#requestBut").value("Request Sent"); 
          }).fail(function(data){
              // alert('fail');
              $("#message").text("Please try Again");
              showMessage();
          });
        } else {
           // alert("asda");
           $("#message").text("Request has been sent");
           showMessage();
        }
    });
  

</script>
     
    </body>
    </html>