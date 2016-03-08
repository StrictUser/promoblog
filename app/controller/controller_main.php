<?php
	class Controller_Main extends Controller
	{

		public function __construct(){
			parent::__construct();
			$this->model = new Model_Article();
		}

		public function action_index(){
			try {
				$data = $this->model->last_posted();
				$this->view->generate('main_view.php', 'template_view.php', $data);
			}catch(Exception $e){
				$error = 'There is an error: ' . $e->getMessage() . '<br>' . $e->getCode() . '<br>' . $e->getLine() . '<br>' . $e->getFile();
				die($error);
			}
		}
	}