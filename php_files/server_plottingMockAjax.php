<?php
include('db_conn.php');

$m = $_POST['markers'];

$markers = json_decode($m);

$id = 100;

$counter = 0;
foreach($markers as $markerObject){
	var_dump($markerObject);
		
		$lat = $markerObject->lat;
		$lng = $markerObject->lng;
		if($counter < 1){
			$counter++;
			$conn->query("INSERT INTO target(operation_id, lat, lng) VALUES ('$id', '$lat', '$lng')");
		}else{
			$conn->query("INSERT INTO checkpoints(operation_id, lat, lng) VALUES ('$id', '$lat', '$lng')");
		}
}

echo "Data have been saved";
?>