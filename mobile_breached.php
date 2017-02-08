<?php
header('Access-Control-Allow-Origin: *');
	include('db_conn.php');
	if(isset($_POST['password']) && isset($_POST['id'])){
		$location = $_POST['breached'];
		$checkpointName = $_POST['checkpointName'];
		$id = $_POST['id'];
		$password = $_POST['password'];
		$stmt = $conn->prepare("SELECT c.id AS id, o.lat AS lat, o.lng AS lng FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN on_going_operation AS o ON c.id = o.checkpoint_id WHERE t.operation_id = :op AND t.operation_password = :pa AND c.name = :na");
		$stmt->bindValue(":op", $id);
		$stmt->bindValue(":pa", $password);
		$stmt->bindValue(":na", $checkpointName);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$checkpoint_id = $row["id"];
		$checkpoint_lat = $row["lat"];
		$checkpoint_lng = $row["lng"];
		
		$date = date('Y-m-d H:i:s');

		$breached = $conn->prepare("UPDATE on_going_operation SET breached = :br WHERE checkpoint_id = :cId");
		$breachedLocation = $conn->prepare("INSERT INTO breached (checkpoint_id, lat, lng, time_happened) VALUE (:ch, :la, :ln, :ti)");
		$breachedLocation->bindValue(':ch', $checkpoint_id);
		$breachedLocation->bindValue(':la', $checkpoint_lat);
		$breachedLocation->bindValue(':ln', $checkpoint_lng);
		$breachedLocation->bindValue(':ti', $date);
		if($stmt->rowCount() === 1){
		$breached->bindValue(':br', 'yes');
		$breached->bindValue(':cId', $checkpoint_id );
		$breached->execute();
		$breachedLocation->execute();
			echo "Successul Deployment of breach!";
		}else{
			echo "Invalid Password";
		}	
	}
?>