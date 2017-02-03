<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$name = $_POST['name'];
$id = $_POST['operation'];

$sql = $conn->prepare('SELECT * FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN on_going_operation AS o ON c.id = o.checkpoint_id WHERE c.operation_id = :id AND c.name != :name');
$sql->bindValue(':id', $id);
$sql->bindValue(':name', $name);
$sql->execute();

while ($row = $sql->fetch(PDO::FETCH_ASSOC)){
 
  $r[] = $row; 
}

echo json_encode($r);
?>