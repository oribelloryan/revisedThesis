<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$id = $_POST['id'];
if(isset($_POST['src']) && $_POST['src'] =='save'){

$data = $_POST['markers'];

$markers = json_decode($data);

foreach($markers as $marker){
	$lat = $marker->lat;
	$lng = $marker->lng;
	$name = $_POST['name'];
	$checkpointId = $_POST['checkpointId'];
	$sql = $conn->prepare("INSERT INTO breached_checkpoint (name, lat, lng, operation_id, checkpoint_id) VALUES (:name, :lat, :lng, :op, :che)");
	$sql->bindValue(':name', $name);
	$sql->bindValue(':lat', $lat);
	$sql->bindValue(':lng', $lng);
	$sql->bindValue(':op', $id);
	$sql->bindValue(':che', $checkpointId);
	$sql->execute();
	echo $sql->rowCount();
}

}else if(isset($_POST['src']) && $_POST['src'] =='update'){
$sql = $conn->query("SELECT * FROM breached_checkpoint WHERE operation_id = $id");
while($row = $sql->fetch(PDO::ASSOC)){
	$r[] = $row;
}
$data = array("breached" => $r);
echo json_encode($data);
}
?>