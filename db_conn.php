<?php
	try {
		$host = 'localhost';
		$db   = 'interceptor';
		$user = 'root';
		$pass = '';
		$charset = 'utf8';
		$options = [
		    'cost' => 11,
		    'salt' => mcrypt_create_iv(25, MCRYPT_DEV_URANDOM),
		];

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$opt = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
				
		$conn = new PDO($dsn, $user, $pass, $opt);


	} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
?>