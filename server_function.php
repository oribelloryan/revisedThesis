<?php
	include('db_conn.php');

	class Operation{
		var $id;
		var $conn;

		function __construct($conn){
			$this->conn = $conn;
		}
 
   		function get_id() {
			return $this->id;
		}

		function set_id(){
			$result = $this->conn->query("SELECT MAX(operation_id) as id FROM tbl_operations");
			$row = $result->fetch(PDO::FETCH_ASSOC);
			$this->id = $row['id'];
		}

		function add_officer($id, $title, $name, $designation, $con, $marked){
			$sql = "INSERT INTO checkpoint_composition(checkpoint_id, title, name, designation, contact, marked_vehicle) VALUES (:id, :title, :name, :desig, :con, :marked)";
			$result = $this->conn->prepare($sql);
			$result->bindValue(':id', $id);
			$result->bindValue(':title', $title);
			$result->bindValue(':name', $name);
			$result->bindValue(':desig', $designation);
			$result->bindValue(':con', $con);
			$result->bindValue(':marked', $marked);
			$result->execute();

		}
	}

	$operation = new Operation($conn);
	$operation->set_id();
?>