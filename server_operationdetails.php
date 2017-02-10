<?php
header('Access-Control-Allow-Origin: *');
include("db_conn.php");


$id = $_GET['id'];

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Search the rows in the markers table 
$query = "SELECT b.lat AS lat, b.lng AS lng, c.name AS name, b.id AS id FROM tbl_operations AS t JOIN checkpoints AS c ON t.operation_id = c.operation_id JOIN breached AS b ON c.id = b.checkpoint_id WHERE t.operation_id = $id";
$result = $conn->query($query);

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = $result->fetch(PDO::FETCH_ASSOC)){
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("id", $row['id']);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
}

echo $dom->saveXML();
?>