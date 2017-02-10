<?php
header('Access-Control-Allow-Origin: *');
include("db_conn.php");

$id = $_GET['id'];

$sql = $conn->query("SELECT * FROM breached_checkpoint WHERE operation_id = $id");

while($row = $sql->fetch(PDO::FETCH_ASSOC)){
	$r[] = $row;
}
$data = array("newBreached" => $r);
echo json_encode($data);

?>