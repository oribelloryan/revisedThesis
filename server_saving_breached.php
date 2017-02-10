<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$id = $_POST['id'];
if(isset($_POST['src']) && $_POST['src'] =='save'){

$lat = $_POST['lat'];
$lng = $_POST['lng'];
$name = $_POST['name'];

$sql = $conn->prepare("INSERT INTO breached_checkpoint (name, lat, lng, operation_id) VALUES (:name, :lat, :lng, :op)");
$sql->bindValue(':name', $name);
$sql->bindValue(':lat', $lat);
$sql->bindValue(':lng', $lng);
$sql->bindValue(':op', $id);
$sql->execute();
echo $sql->rowCount();
}else if(isset($_POST['src']) && $_POST['src'] =='update'){
$sql = $conn->query("SELECT * FROM breached_checkpoint WHERE operation_id = $id");
while($row = $sql->fetch(PDO::ASSOC)){
	$r[] = $row;
}
$data = array("breached" => $r);
echo json_encode($data);
}
?>