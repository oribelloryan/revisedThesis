<?php
	header('Access-Control-Allow-Origin: *');
	require("db_conn.php");

	$id = $_GET["id"];

	// SELECT * FROM checkpoints AS c LEFT JOIN checkpoint_composition AS cc ON c.id = cc.checkpoint_id WHERE c.operation_id = $id
	$query = "SELECT * FROM checkpoints WHERE operation_id = $id";
	$result = $conn->query($query);

	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
	 
	  $r[] = $row;
	  
	}
	$data = array("checkpoints" => $r);
	echo json_encode($data);
?>