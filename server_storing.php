<?php
	header('Access-Control-Allow-Origin: *');
	include('server_function.php');

	if(isset($_POST["submit"]) && $_POST['location'] == "server_create_plan"){

		$op_name = $_POST['operation_name'];
		$op_pass = password_hash($_POST['operation_password'], PASSWORD_BCRYPT, $options);
		$date_execute = $_POST['execute'];
		$officers = $_POST['num_officers'];

		$sql_insert = "INSERT INTO tbl_operations (operation_name, operation_password, date_plan, date_execute, num_officers, mission_status)
		VALUES ('$op_name','$op_pass',current_date(),'$date_execute','$officers', 'not done')";

		$commit = $conn->query($sql_insert);
		header('location: server_profiling.php');
	}else if($_POST['location'] == "server_profiling"){
		
		$name = $_POST['target_name'];
		$age = $_POST['target_age'];
		$gender = $_POST['target_gender'];
		$height = $_POST['target_height'];
		$crime = $_POST['target_crime'];
		
		$id = $operation->get_id();
		$imageFileType = pathinfo( $_FILES['pic']['name'], PATHINFO_EXTENSION);
		$target_dir = "images/criminals/";
		$target_file = $target_dir . $id . '.'.$imageFileType ;

		$pic = $_FILES['pic']['tmp_name'];
		move_uploaded_file($pic, $target_file);
		// var_dump($imageFileType);
		$sql = "INSERT INTO criminal_profiling (name, age, gender, height, crime, image, operation_id) VALUES ('$name', '$age', '$gender', '$height', '$crime', '$target_file', '$id')";
		$query = $conn->query($sql);
		header('location: server_plotting.php');

	}else if($_POST['location'] == "server_plotting"){
		$target = $_POST['target'];
		$checkpoints = $_POST['checkpoints'];
		$id = $_SESSION['id'];

		$sql = "INSERT INTO plotting(operation_id, target_location, checkpoint_targets) VALUES ('$id', '$target', '$checkpoints')";
		$result = $conn->query($sql);

		echo "Data have been saved";
	}else if($_POST['location'] == "server_officer_profiling"){
		$name = $_POST['name'];
		$age = $_POST['age'];
		$height = $_POST['height'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		
		$p = $_FILES['police']['name'];
		$imageFileType = pathinfo( $_FILES['police']['name'], PATHINFO_EXTENSION);
		$target_dir = "images/polices/";
		$target_file = $target_dir . $name . '.'.$imageFileType ;

		$pic = $_FILES['police']['tmp_name'];
		move_uploaded_file($pic, $target_file);
		$sql = "INSERT INTO police_profiling (name, age, gender, height, position, image) VALUES ('$name', '$age', '$gender', '$height', '$position', '$target_file')";
		$query = $conn->query($sql);
		header('location: index.php');
	}else if($_POST['location'] == "server_officer_designation"){
		$lead = $_POST['lead'];
		$lead_name = $_POST['lead_name'];
		$lead_pos = $_POST['lead_pos'];
		$title = $_POST['title'];
		$name = $_POST['officer'];
		$desig = $_POST['designation'];
		$id = $_POST['checkpoint'];
		$operation->add_officer($id, $lead, $lead_name, $lead_pos, '2324', 'MC 421D' );
		for($i = 0; $i < sizeof($title); $i++){
			$operation->add_officer($id, $title[$i], $name[$i], $desig[$i], '2324', 'MC 421D' );

		}
		header('location: server_checkpointLabeling.php?operation_id='.$operation->get_id());
	}		
?>