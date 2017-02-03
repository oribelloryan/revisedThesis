<?php
header('Access-Control-Allow-Origin: *');
	include('db_conn.php');

	$name = $_POST['name'];
	$lat = $_POST['lat'];
	$lng = $_POST['lng'];
	$date = $_POST['date'];
	$counter = $_POST['counter'];
	

	$stmt = $conn->prepare("SELECT * FROM checkpoints WHERE name = :name");
	$stmt->bindValue(':name', $name);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	$id = $result['id'];
	echo $id;

	$loc = $conn->prepare("SELECT * FROM on_going_operation WHERE checkpoint_id = :id");
	$loc->bindValue(':id', $id);
	$loc->execute();

	if($stmt->rowCount() === 1){
		if($loc->rowCount() == 1){
		$location = $conn->prepare("UPDATE on_going_operation SET lat = :la, lng = :ln, time_updated = :ti, counter = :co WHERE checkpoint_id = :che");
		$location->bindValue(':la', $lat);
		$location->bindValue(':ln', $lng);
		$location->bindValue(':che', $id);
		$location->bindValue(':ti', $date );
		$location->bindValue(':co', $counter);
		$location->execute();	
	
		
		echo "Updated";
	
	}else{
		$breached = 'no';
		$insert = $conn->prepare("INSERT INTO on_going_operation(checkpoint_id, breached) VALUES (:i, :br)");
		$insert->bindValue(':i', $id);
		$insert->bindValue(':br', $breached);
		$insert->execute();
	}
	}else{
		echo "You're not part of the team";
	}
	
?>