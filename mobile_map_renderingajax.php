<?php
 include('db_conn.php');

 $id = $_POST['id'];

 $sql = "SELECT * FROM tbl_operations WHERE operation_id =  $id";
 $result = $conn->query($sql);
 while($row = $result->fetch(PDO::FETCH_ASSOC)){
 $data = array(
 'name' => $row['operation_name'],
 'date_plan' => $row['date_plan'],
 'date_execute' => $row['date_execute'],
 'officers' => $row['num_officers'],
 );
};

 echo json_encode($data);
 
?>