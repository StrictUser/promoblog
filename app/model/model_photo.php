<?php
	class Model_Photo extends Model
	{
		use Model_DB;

		protected function download_photo($file_temp_name, $file_orig_name, $file_type, $file_desc){
			$data = file_get_contents($file_temp_name);

			if(!is_uploaded_file($file_temp_name)){
				die('file was not uploaded!');
			}

			$pdo = $this->get_connect2db();

			try{
				$sql = 'INSERT INTO files SET
											filename = :filename,
											mimetype = :mimetype,
											description = :description,
											data = :data';
				$s = $pdo->prepare($sql);
				$s->bindValue(':filename', $file_orig_name);
				$s->bindValue(':mimetype', $file_type);
				$s->bindValue(':description', $file_desc);
				$s->bindValue(':data', $data);
				$s->execute();
			}catch(PDOException $e) {
				$error = 'Error into saving file to database: ' . $e->getMessage();
				die($error);
			}
		}

		protected function get_file($id){
			$pdo = $this->get_connect2db();

			try{
				$sql = 'SELECT id, filename, mimetype, description FROM files WHERE article_id=:article_id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':article_id', $id);
				$s->execute();
			}catch(PDOException $e){
				$error = 'Error in getting file from database: ' . $e->getMessage();
				die($error);
			}
			return $s->fetch();
		}

		protected function del_file($id){
			$pdo = $this->get_connect2db();

			try
			{
				$sql = 'DELETE FROM files WHERE id = :id';
				$s = $pdo->prepare($sql);
				$s->bindValue(':id', $id);
				$s->execute();
			}catch (PDOException $e){
				$error = 'Error in deleting file from database: ' . $e->getMessage();
				die($error);
			}

			header('Location: .');
			exit();
		}

	}