<?php
header('Access-Control-Allow-Origin: *');
include('db_conn.php');

$end = $_POST['id'];
$sql = $conn->query("UPDATE tbl_operations SET mission_status = 'finished' WHERE operation_id = $end");
if($sql->rowCount() == 1){
	echo "success";
}else{
    echo "error";
}
?>