<?php
header('Access-Control-Allow-Origin: *');
include("db_conn.php");

$checkpoint = $_GET['checkpoint'];
$stmt = $conn->prepare("UPDATE on_going_operation SET breached = 'no' WHERE checkpoint_id = :checkpoint ");
$stmt->bindValue(':checkpoint', $checkpoint);
$stmt->execute();
echo "done";
?>