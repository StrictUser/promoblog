<?php

	class Controller_category extends Controller {

		public function __construct(){
			parent::__construct();
			$this->model = new Model_Category();
		}

		public function action_index(){
			$data = $this->model->categories();
			$this->view->generate('category_view.php', 'template_view.php', $data);
		}

		public function create_category(){
			$name = clean_query($_POST['category_name']);
			$create = $this->model->add_category($name);
			$this->view->generate('category_view.php', 'template_view.php', $create);
		}

		public function change_category(){

		}

		public function view_category(){
			$id = '';
			$data = $this->model->category($id);
		}
	}