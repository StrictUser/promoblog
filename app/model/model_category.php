<?php
	class Model_Category extends Model{

		protected function get_connect2db(){
			require_once '/DB/connect.php';
		}

		public function create_dbtable($name){
			self::get_connect2db();
			$pdo->beginTransaction();
			try{
				$sql = "CREATE TABLE $name DEFAULT CHARACTER SET utf8 ENGINE=InnoDB";
				$s = $pdo->execute
			}

			return $sql;
		}

		public function create_dbtable_column($name, $type, $primary, $is_a_null){
			$primary = ($primary == TRUE) ? 'PRIMARY KEY' : '';
			$is_a_null = ($is_a_null == FALSE) ? 'NOT NULL' : 'NULL';
			return "($name $type $is_a_null $primary)";
		}

		public function add_colomn2dbtable($table){
			self::get_connect2db();
			$name = '';
			$type = '';
			$col = self::create_dbtable_column($name, $type, 'FALSE', 'TRUE');
			$sql = "ALTER TABLE $table ADD $col";
			return $sql;
		}

		public function get_categories(){
			self::get_connect2db();
			try {
				$sql = "SELECT name FROM category";
				$s = $pdo->prepare($sql);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in getting categories: ' . $e->getMessage();
				echo $error;
				exit();
			}
		}


	}