<?php
header('Access-Control-Allow-Origin: *');
	include('db_conn.php');
	if(isset($_POST['password']) && isset($_POST['id'])){
		$location = $_POST['breached'];
		$checkpointName = $_POST['checkpointName'];
		$id = $_POST['id'];
		$password = $_POST['password'];
		$time = $_POST['time'];

		$stmt = $conn->prepare("SELECT c.id AS id, o.lat AS lat, o.lng AS lng, t.operation_password AS password FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN on_going_operation AS o ON c.id = o.checkpoint_id WHERE t.operation_id = :op AND c.name = :na");
		$stmt->bindValue(":op", $id);
		$stmt->bindValue(":na", $checkpointName);
		$stmt->execute();
		// var_dump($stmt);
		// var_dump($location);
		// var_dump($checkpointName);
		// var_dump($id);
		// var_dump($password);
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$hashed = $row['password'];
		if(password_verify($password, $hashed)){
			$checkpoint_id = $row["id"];
			$checkpoint_lat = $row["lat"];
			$checkpoint_lng = $row["lng"];

			$breached = $conn->prepare("UPDATE on_going_operation SET breached = :br WHERE checkpoint_id = :cId");
			$breachedLocation = $conn->prepare("INSERT INTO breached (checkpoint_id, lat, lng, time_happened) VALUE (:ch, :la, :ln, :ti)");
			$breachedLocation->bindValue(':ch', $checkpoint_id);
			$breachedLocation->bindValue(':la', $checkpoint_lat);
			$breachedLocation->bindValue(':ln', $checkpoint_lng);
			$breachedLocation->bindValue(':ti', $time);
			
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