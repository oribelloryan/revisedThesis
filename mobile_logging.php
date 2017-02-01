<?php
include('db_conn.php');

$operation = $_POST['name'];
$password = $_POST['pass'];
$checkpoint = $_POST['check'];
$stmt = $conn->prepare("SELECT * FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id WHERE t.operation_name = :op AND t.operation_password = :pa AND c.name = :ch LIMIT 1");
$stmt->bindValue(":op", $operation);
$stmt->bindValue(":pa", $password);
$stmt->bindValue(":ch", $checkpoint);
$stmt->execute();

if($stmt->rowCount() === 1)
{
	$row = $stmt->fetch(PDO::FETCH_ASSOC);;
    echo json_encode($row);
}else{
	echo json_encode('NoRecord');
}
?>