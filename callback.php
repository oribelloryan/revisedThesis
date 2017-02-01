<?php
header('Access-Control-Allow-Origin: *');
	include('db_conn.php');
	if(isset($_POST['password']) && isset($_POST['id'])){
		$location = $_POST['breached'];
		$checkpointName = $_POST['checkpointName'];
		$id = $_POST['id'];
		$password = $_POST['password'];
		$stmt = $conn->prepare("SELECT * FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id WHERE t.operation_id = :op AND t.operation_password = :pa AND c.name = :na LIMIT 1");
		$stmt->bindValue(":op", $id);
		$stmt->bindValue(":pa", $password);
		$stmt->bindValue(":na", $checkpointName);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$checkpoint_id = $row["id"];


		$breached = $conn->prepare("UPDATE on_going_operation SET breached = :br WHERE checkpoint_id = :cId");
		if($stmt->rowCount() === 1){
		$breached->bindValue(':br', 'yes');
		$breached->bindValue(':cId', $checkpoint_id );
		$breached->execute();
			echo "Successul Deployment of breach!";
		}else{
			echo "Invalid Password";
		}	
	}
?>