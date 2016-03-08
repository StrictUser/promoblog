<?php
	class Controller_Article extends Controller
	{

		public function __construct(){
			parent::__construct();
			$this->model = new Model_Article();
		}

		public function action_index(){
			if(isset($_POST['action']) && $_POST['action'] === 'view'){
				$id = (int)clean_query($_POST['id']);
				$data = $this->model->show_article_by_id($id);
				$this->view->generate('article_view.php', 'template_view.php', $data);
			}else{
				$data = $this->model->last_posted();
				$this->view->generate('article_view.php', 'template_view.php', $data);
			}
		}
	}