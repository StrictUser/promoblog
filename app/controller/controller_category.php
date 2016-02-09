<?php
	class Controller_Category extends Controller {
		function __construct(){
			$this->model = new Model_Category();
			$this->view = new View();
		}

		public function action_index()
		{
			$data = $this->model->get_categories();
			$this->view->generate('category_view.php', 'template_view.php', $data);
		}

	}