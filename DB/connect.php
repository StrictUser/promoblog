<?php

		$file = 'params.php';

		if(file_exists($file)) {
			try {
				include_once $file;
				$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec('SET NAMES "utf8"');
			} catch (PDOException $e) {
				$output = 'Cannot connect to database server.' . $e->getMessage();
				die("<h3>$output</h3>");
			}
		}else{
			die('Parameters for connection was not specified.');
		}