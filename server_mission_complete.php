<?php
	header('Access-Control-Allow-Origin: *');
	include('db_conn.php');
	$source = $_POST['source'];
	$id = $_POST['id'];
	
	if( $source == 'complete'){
		$time = $_POST['time'];
	
		$sql = $conn->query("UPDATE tbl_operations SET mission_status = 'finished', mission_completed = '$time' WHERE operation_id = $id");
		
		if($sql->rowCount() == 1){
			echo "success";
		}else{
		    echo "success";
		}
	}else if( $source == 'pass'){

		$password = $_POST['password'];
		$sql = "SELECT * FROM tbl_operations WHERE operation_id = $id";
		$r = $conn->query($sql);
		$result = $r->fetch(PDO::FETCH_ASSOC);
		$hashed = $result['operation_password'];
		if(password_verify($password, $hashed)){
			echo "valid";
		}else{
			echo "invalid";
		}
	}
?>