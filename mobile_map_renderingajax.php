<?php
	header('Access-Control-Allow-Origin: *');
	 include('db_conn.php');

	 $id = $_POST['id'];

	 $sql = "SELECT tbl.operation_name AS operation_name, tbl.operation_password AS password, tbl.date_plan AS date_plan, tbl.date_execute AS date_execute, tbl.num_officers AS officers, t.location AS location, cp.image AS image, tbl.mission_completed AS mission FROM tbl_operations AS tbl JOIN target AS t ON tbl.operation_id = t.operation_id JOIN criminal_profiling AS cp ON tbl.operation_id = cp.operation_id JOIN checkpoints AS c ON tbl.operation_id = c.operation_id WHERE tbl.operation_id =  $id";
	 $result = $conn->query($sql);

	 while($row = $result->fetch(PDO::FETCH_ASSOC)){
	 $data = array(
			 'name' => $row['operation_name'],
			 'password' => $row['password'],
			 'date_plan' => $row['date_plan'],
			 'date_execute' => $row['date_execute'],
			 'officers' => $row['officers'],
			 'location' => $row['location'],
			 'criminal_image' => $row['image'],
			 'mission' => $row['mission']
	 		);
	};

	 echo json_encode($data);
 
?>