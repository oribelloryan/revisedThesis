<?php
include('db_conn.php');

$sql = "SELECT MAX(operation_id) as max FROM tbl_operations";
$row = $conn->query($sql);
$last_id = $row->fetch(PDO::FETCH_ASSOC);

$checkpoints = $_POST['checkpoints'];
$id = $last_id['max'];

$checkpointJson = json_decode($checkpoints);
$checkpointLat = json_encode($checkpointJson[0]->latlng->lat);
$checkpointLng = json_encode($checkpointJson[0]->latlng->lng);

foreach($checkpointJson as $key){
$lat = $key->latlng->lat;
$lng = $key->latlng->lng;
var_dump($lng);
$conn->query("INSERT INTO checkpoints(operation_id, lat, lng) VALUES ('$id', '$lat', '$lng')");
}

echo "Data have been saved";
?>