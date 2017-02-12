<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$m = $_POST['markers'];
$r = $_POST['radius'];
$c = $_POST['checkpoint'];

$markers = json_decode($m);

$sql = "SELECT MAX(operation_id) as max FROM tbl_operations";
 
$row = $conn->query($sql);
$last_id = $row->fetch(PDO::FETCH_ASSOC);
$id = $last_id['max'];

$counter = 0;

$update = "UPDATE tbl_operations SET num_officers = '$c' WHERE operation_id = '$id'";
$conn->query($update);
foreach($markers as $markerObject){
	// var_dump($markerObject);
		
		$lat = $markerObject->lat;
		$lng = $markerObject->lng;
		$loc = $markerObject->location;
		if($counter < 1){
			
			$conn->query("INSERT INTO target(operation_id, lat, lng, radius, location) VALUES ('$id', '$lat', '$lng', '$r', '$loc')");
		}else{
			$name = 'chcpt'.$counter;
			$conn->query("INSERT INTO checkpoints(operation_id, name, lat, lng, location) VALUES ('$id', '$name','$lat', '$lng', '$loc')");
		}
		$counter++;
}

$response = array("status"=>"ok","id"=>$id);
echo json_encode($response);

// $sql = "SELECT MAX(operation_id) as max FROM tbl_operations";
// $row = $conn->query($sql);
// $last_id = $row->fetch(PDO::FETCH_ASSOC);

// $target = $_POST['target'];
// $checkpoints = $_POST['checkpoints'];
// $id = $last_id['max'];
// $targetJson = json_decode($target);
// $targetLat = json_encode($targetJson->lat);
// $targetLng = json_encode($targetJson->lng);

// $conn->query("INSERT INTO target(operation_id, lat, lng) VALUES ('$id', '$targetLat', '$targetLng')");

// $sql = "INSERT INTO plotting(operation_id, target_location, checkpoint_targets) VALUES ('$id', '$target', '$checkpoints')";
// $result = $conn->query($sql);

// echo "Data have been saved";
?>