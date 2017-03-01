<?php
	header('Access-Control-Allow-Origin: *');
	include("db_conn.php");

	$id = $_GET['id'];
	$stmt = $conn->prepare("SELECT b.id AS id, b.checkpoint_id AS checkpoint_id, b.lat AS lat, b.lng AS lng, b.time_happened AS time_happened, c.name AS name, o.breached AS breached FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN breached AS b ON c.id = b.checkpoint_id JOIN on_going_operation AS o ON o.checkpoint_id = c.id WHERE t.operation_id = :id AND o.breached = 'yes' ");
	$stmt->bindValue(':id', $id);
	$stmt->execute();

	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$r[] = $row;
	}
	$data = array("breached" => $r);
	echo json_encode($data);

?>