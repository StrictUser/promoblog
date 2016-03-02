<?php
	class Controller_main extends Controller
	{

		public function __construct(){
			parent::__construct();
			$this->model = new Model_Article;
		}

		public function action_index(){
			$data = $this->model->last_posted();
			$this->view->generate('main_view.php', 'template_view.php', $data);
		}
	}