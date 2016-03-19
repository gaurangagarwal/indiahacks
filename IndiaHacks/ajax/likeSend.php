<?php 
$id = $_POST['id'];
$type = $_POST['type'];
// return $id;
$data = "eloo";
$conn = mysqli_connect("localhost","root","", "indiahacks");
if(!$conn)
	echo json_decode($conn);
$likes =0;
if($type == "do") {
	$selectSql = "SELECT * FROM dodata  WHERE doID = $id";
	$selectQuery = mysqli_query($conn, $selectSql);
	$row = mysqli_fetch_assoc($selectQuery);
	
	$likes = $row['likes'];
	$likes +=1; 
	$sql = "UPDATE dodata SET likes = $likes WHERE doID=$id";			

} else if($type == "dont"){
	$selectSql = "SELECT * FROM dontdata  WHERE dontID = $id";
	$selectQuery = mysqli_query($conn, $selectSql);
	$row = mysqli_fetch_assoc($selectQuery);
	
	$likes = $row['likes'];
	$likes +=1; 
	$sql = "UPDATE dontdata SET likes = $likes WHERE dontID = $id";			
} else {
	$selectSql = "SELECT * FROM appdata  WHERE appID = $id";
	$selectQuery = mysqli_query($conn, $selectSql);
	$row = mysqli_fetch_assoc($selectQuery);	
	$likes = $row['likes'];
	$likes +=1; 
	$sql = "UPDATE appdata SET likes = $likes WHERE appID = $id";	
}
mysqli_query($conn, $sql);
echo json_encode($likes);
?> 