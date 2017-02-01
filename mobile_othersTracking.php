<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$name = $_POST['name'];
$id = $_POST['operation'];

$sql = $conn->prepare('SELECT * FROM tbl_operations AS t, checkpoints AS c, on_going_operation on o ON t.operation_id = c.operation_id = ');
echo "success";
?>