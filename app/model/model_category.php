<?php

	class Model_Category extends Model
	{
		private function get_categories_from_db(){
			$pdo = parent::get_connect2db();
			try {
				$sql = 'SELECT id, name FROM category';
				$data = $pdo->query($sql);
			}catch(PDOException $e){
				$error = 'Error in getting info about categories: ' . $e->getMessage();
				die($error);
			}

			$categories = array();
			foreach ($data as $item) {
				$categories['id'] = $item['id'];
				$categories['name'] = $item['name'];
			}
			return $categories;
		}

		public function categories(){
			return $this->get_categories_from_db();
		}

		protected function get_dbcategory($id){
			$pdo = parent::get_connect2db();
			try {
				$sql = 'SELECT id, name FROM category WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in getting info about category: ' . $e->getMessage();
				die($error);
			}
			return $s->fetch();
		}

		public function category($id){
			$this->get_dbcategory($id);
		}

		protected function add_category2db($name){
			$pdo = parent::get_connect2db();
			try{
				$sql = 'INSERT INTO category (id, name) VALUES(NULL, :name)';
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $name);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in adding category: ' . $e->getMessage();
				die($error);
			}
		}

		public function add_category($name){
			$this->add_category2db($name);
		}

		protected function edit_dbcategory($id, $name){
			$pdo = parent::get_connect2db();
			try{
				$sql = 'UPDATE category SET name=:name WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':name', $name);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in updating category: ' . $e->getMessage();
				die($error);
			}
		}

		protected function del_dbcategory($id){
			$pdo = parent::get_connect2db();
			try{
				$sql = 'DELETE FROM articlecategory WHERE categoryid=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting articles from category: ' . $e->getMessage();
				die($error);
			}

			try{
				$sql = 'DELETE FROM category WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting category: ' . $e->getMessage();
				die($error);
			}
		}
	}