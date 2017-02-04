<?php
include('db_conn.php');

$id = $_GET['id'];

$query = "SELECT c.name AS name, c.lat AS checkpointLat, c.lng AS checkpointLng, o.breached AS breached , o.lat AS lat, o.lng AS lng, o.time_updated as timeUpdated, o.counter AS counter FROM checkpoints AS c JOIN on_going_operation AS o ON c.id = o.checkpoint_id WHERE c.operation_id = $id";

$result = $conn->query($query);

while ($row = $result->fetch(PDO::FETCH_ASSOC)){
 
  $r[] = $row;

}

$data = array("polices" => $r);
echo json_encode($data);
?>