<?php
	if(file_exists('params.php')) {
		try {
			include_once 'params.php';
			$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->exec('SET NAMES "utf8"');
		} catch (PDOException $e) {
			$output = 'Cannot connect to database server.' . $e->getMessage();
			echo "<h3>$output</h3>";
			exit();
		}
	}else{
		die('Parameters for connection was not specified.');
	}