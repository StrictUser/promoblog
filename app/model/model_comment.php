<?php
	class Model_Comment extends Model
	{
		use Model_DB;

		protected function add_comment($comment, $article_id){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'INSERT INTO comments SET
												com_text = :com_text,
												com_date = CURDATE(),
												article_id = :article_id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':com_text', $comment);
				$s->bindValue(':article_id', $article_id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in adding comment: ' . $e->getMessage();
				die($error);
			}
		}

		protected function edit_comment($id, $comment){
			$pdo = $this->get_connect2db();
			try{
				$sql = 'UPDATE comments SET com_text=:comment WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':comment', $comment);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in editing comment: ' . $e->getMessage();
				die($error);
			}
		}

		protected function del_comment($id){
			$pdo = $this->get_connect2db();

			try{
				$sql = 'DELETE FROM articlecomment WHERE comment_id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting comment from article: ' . $e->getMessage();
				die($error);
			}

			try{
				$sql = 'DELETE FROM comments WHERE id=:id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in deleting comment from database: ' . $e->getMessage();
				die($error);
			}
		}
	}