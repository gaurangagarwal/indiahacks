<?php
session_start();
$conn = mysqli_connect("localhost","root","","indiahacks");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// if(!isset($_SESSION['place']['req'])) {
//   $_SESSION['place']['req'] = true;
// } 

//$postPlaceReq = $_SESSION['place']['req'];
$postPlaceState = $_SESSION['place']['placeState'];
$postPlaceCountry =	$_SESSION['place']['placeCountry'] ;
$postPlaceID = $_SESSION['place']['placeID'] ;
$postLocation = $_SESSION['place']['location'];


$sql = "SELECT * FROM userdet WHERE State = '$postPlaceState' && Country = '$postPlaceCountry'";      
echo json_encode($sql);

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) >0) {
  while($row = mysqli_fetch_assoc($result)) {
  	echo json_encode($row['Name']);
    for ($i=1; $i <=3 ; $i++) { 
  		$colName = "ReqLocation".$i;
  		
      if($row[$colName] == null) {
  			$updateReq = "UPDATE userdet SET $colName = '$postLocation' WHERE State = '$postPlaceState' && Country = '$postPlaceCountry'";
  			mysqli_query($conn, $updateReq);
        echo json_encode($updateReq);
  			break;
  		} else {
  			if($row[$colName] == $postLocation)
  				break;
  		}
  	}  
  }
}

?>