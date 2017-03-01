<?php
	header('Access-Control-Allow-Origin: *');
	include('db_conn.php');

	if(isset($_POST['id'])){
		$response = array();
		$id = $_POST['id'];
		$name = $_POST['name'];
		$updateName = $conn->prepare("UPDATE checkpoints SET name = :name WHERE id = :id");
		$updateName->bindValue(':name', $name);
		$updateName->bindValue(':id', $id);
		$updateName->execute();
	    echo $updateName->rowCount();
	}
?>