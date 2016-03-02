<?php
	class Model_Article extends Model
	{

		private function add_articles_to_db($title, $text, $category_id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'INSERT INTO articles SET
												title = :title,
												text = :text,
												date = CURDATE(),
												category_id = :category_id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':title', $title);
				$s->bindValue(':text', $text);
				$s->bindValue(':category', $category_id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in adding article: ' . $e->getMessage();
				die($error);
			}
		}

		private function edit_article_in_db($id, $title, $text, $category_id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'UPDATE articles SET
											title=:title,
											text=:text,
											category_id=:category_id
										WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':title', $title);
				$s->bindValue(':text', $text);
				$s->bindValue(':category_id', $category_id);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in updating article: ' . $e->getMessage();
				die($error);
			}
		}

		private function del_article_from_db($id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'DELETE FROM articletags WHERE articleid=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting tags from article: ' . $e->getMessage();
				die($error);
			}

			try{
				$sql = 'DELETE FROM articles WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting article: ' . $e->getMessage();
				die($error);
			}
		}

		private function get_articles_from_db_in_category($category_id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'SELECT id, title, text, date FROM articles WHERE category_id=:category_id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':category_id', $category_id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in getting articles: ' . $e->getMessage();
				die($error);
			}
			$result = $s->fetchAll();
			foreach ($result as $row) {
				$articles[] = array(
					'id' => $row['id'],
					'title' => $row['title'],
					'text' => $row['text'],
					'date' => $row['date']
				);
			}
			return $articles;
		}

		private function get_article_from_db_by_id($id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'SELECT articles.id AS id, title, text, date, category.name AS category FROM articles INNER JOIN category ON articles.category_id = category.id WHERE articles.id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in getting article: ' . $e->getMessage();
				die($error);
			}

			return $s->fetchAll(PDO::FETCH_ASSOC);
		}

		public function show_article_by_id($id){
			return $this->get_article_from_db_by_id($id);

		}

		private function last_posted_from_db(){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'SELECT articles.id, title, text, date, category.name AS category FROM articles INNER JOIN category ON articles.category_id = category.id ORDER BY date DESC LIMIT 5';
				$result = $pdo->query($sql);
			}catch(PDOException $e){
				$error = 'Error in getting article: ' . $e->getMessage();
				die($error);
			}

			return $result->fetchAll(PDO::FETCH_ASSOC);
		}

		public function last_posted(){
			$art = $this->last_posted_from_db();
			$articles = array();
			foreach ($art as $item) {
				$articles[] = $item;
			}
			return $articles;
		}
	}