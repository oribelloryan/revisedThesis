<?php

include('db_conn.php');

$date = $_POST['date'];

$newDate = date("Y-m-d G:i:s", $date);
// echo $newDate;
// $newDate = FROM_UNIXTIME($date);
$sql = "INSERT INTO tbl_operations (mission_completed) VALUES ( '$newDate' )";
$query = $conn->query($sql);
echo $newDate;


$hash = password_hash("rumple", PASSWORD_BCRYPT, $options);
	
if (password_verify('rumples', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>