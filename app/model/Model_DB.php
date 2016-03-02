<?php
	trait Model_DB
	{
		/* connect to DB */

		protected function get_connect2db(){
			//include_once $_SERVER['DOCUMENT_ROOT'] . '/DB/params.php';
			$base = DBNAME;
			$host = DBHOST;
			try {
				$pdo = new PDO("mysql:host=$host;dbname=$base;charset=utf8", DBUSER, DBPASS);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec('SET NAMES "utf8"');
			} catch (PDOException $e) {
				$output = 'Parameters for connection was not specified.' . $e->getMessage();
				die("<h3>$output</h3>");
			}
			return $pdo;
		}

		/* work with DB */

		protected function create_dbtable($name){
			$pdo = $this->get_connect2db();
			try{
				$name = html($name);
				$sql = "CREATE TABLE IF NOT EXISTS $name DEFAULT CHARACTER SET utf8 ENGINE=InnoDB";
				$s = $pdo->prepare($sql);
				$s->execute();
				throw new PDOException('Error in executing SQL command for creating table');
			}catch(PDOException $e){
				echo $e->getMessage();
				echo $e->getLine();
				echo $e->getFile();
			}
		}

		protected function create_dbtable_column($name, $type, $primary, $is_a_null){
			$this->name = $name;
			$this->type = $type;
			$primary = ($primary == TRUE) ? 'PRIMARY KEY' : '';
			$is_a_null = ($is_a_null == FALSE) ? 'NOT NULL' : 'NULL';
			return "($name $type $is_a_null $primary)";
		}

		protected function add_colomn2dbtable($table_name, $col_name, $col_type, $col_primary, $col_is_a_null){
			$pdo = $this->get_connect2db();
			$name = $this->$col_name;
			$type = $this->$col_type;
			$primary = ($col_primary === '')? 'FALSE' : $col_primary;
			$is_a_null = ($col_is_a_null === '')? 'TRUE' : $col_is_a_null;
			$col = $this->create_dbtable_column($name, $type, $primary, $is_a_null);
			$sql = "ALTER TABLE $table_name ADD $col";
			$s = $pdo->prepare($sql);
			$s->execute();
			return $s;
		}

		protected function del_dbtable($name){
			$pdo = $this->get_connect2db();
			try{
				$sql = "DROP TABLE IF EXISTS $name";
				$pdo->query($sql);
			}catch(PDOException $e){
				$error = 'Error in deleting table: ' . $e->getMessage();
				die($error);
			}
		}
	}