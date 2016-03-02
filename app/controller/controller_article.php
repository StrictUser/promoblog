<?php
	class Controller_article extends Controller
	{

		public function __construct(){
			parent::__construct();
			$this->model = new Model_Article;
		}

		public function action_index(){

			include_once $_SERVER['DOCUMENT_ROOT'].'/promo/app/core/functions.php';
			if(isset($_POST['action']) && $_POST['action'] === 'view'){
				$id = clean_query($_POST['id']);
				$id = (int)$id;
				$data = $this->model->show_article_by_id($id);
				$this->view->generate('article_view.php', 'template_view.php', $data);
				//var_dump($data);
			}
		}
	}