<?php
header('Access-Control-Allow-Origin: *');
include("db_conn.php");

// Get parameters from URL
$id = $_GET["id"];


// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Search the rows in the markers table
$query = "SELECT c.name  AS name, c.id AS id, c.lat AS lat, c.lng AS lng, cc.image AS image FROM checkpoints AS c LEFT JOIN checkpoint_composition AS cc ON c.id = cc.checkpoint_id where cc.designation LIKE 'team leader' AND c.operation_id = $id";
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
  $newnode->setAttribute("image", $row['image']);
}

echo $dom->saveXML();
?>