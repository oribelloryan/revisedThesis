<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

if(isset($_POST['id'])){
	$response = array();
	$id = $_POST['id'];
	$name = $_POST['name'];
	$stmt = $conn->prepare("SELECT name FROM checkpoints WHERE id = :id");
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$updateName = $conn->prepare("UPDATE checkpoints SET name = :name WHERE id = :id");
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if($row['name'] === ''){
			// var_dump($name);
			if($name === ''){
				$response['status'] = "noName";
				echo json_encode($response);
			}else{
				$updateName->bindValue(':name', $name);
				$updateName->bindValue(':id', $id);
				$updateName->execute();
				$response['updated'] = "true";
				$response['name'] = $name;
				echo json_encode($response);
			}
		}else{
			$response['status'] = "hasName";
			$response['name'] = $row['name'];
			echo json_encode($response);
		}
}
?>