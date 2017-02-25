<?php
include('db_conn.php');

$operation = $_POST['name'];
$password = $_POST['pass'];
$checkpoint = $_POST['check'];
$stmt = $conn->prepare("SELECT * FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id WHERE t.operation_name = :op AND c.name = :ch LIMIT 1");
$stmt->bindValue(":op", $operation);
$stmt->bindValue(":ch", $checkpoint);
$stmt->execute();

if($stmt->rowCount() === 1)
{	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$hashed = $row['operation_password'];
	if(password_verify($password, $hashed)){
		echo json_encode($row);
	}else{
		echo json_encode("Invalid");
	}
    
}else{
	echo json_encode('NoRecord');
}
?>