<?php
	class Model_Tags extends Model
	{
		use Model_DB;

		protected function add_tags($tagname, $article_id){
			$tagname = mb_split('[\w\-]+/i', $tagname);
			$pdo = $this->get_connect2db();
			try{
				$sql = 'INSERT INTO tags SET
											tagname = :tagname,
											article_id = :article_id';
				$s = $pdo->prepare($sql);
				foreach($tagname as $tag){
					$s->bindValue(':tagname', $tag);
					$s->bindValue(':article_id', $article_id);
				}
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in adding tags: ' . $e->getMessage();
				die($error);
			}
		}

		protected function get_tags_for_article($article_id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'SELECT id, tagname, article_id FROM tags WHERE article_id=:article_id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':article_id', $article_id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in editing tags: ' . $e->getMessage();
				die($error);
			}
			return $s->fetch();
		}

		protected function del_tag($id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'DELETE FROM articletags WHERE tagid=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting tag from article: ' . $e->getMessage();
				die($error);
			}

			try{
				$sql = 'DELETE FROM tags WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting tag: ' . $e->getMessage();
				die($error);
			}
		}
	}