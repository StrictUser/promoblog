<?php
	class Model_Main extends Model_Article{
		public $article;

		public function last_posted(){
			$this->article = new Model_Article();
			$art = $this->article->last_posted_from_db();
			$articles = array();
			foreach ($art as $item) {
				$articles[] = $item;
			}
			return $articles;
		}
	}