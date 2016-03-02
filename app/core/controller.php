<?php

	class Controller
	{
		public $model;
		public $view;

		public function __construct() {
			$this->view = new View;
		}

		public function action_index(){

		}

		public function ErrorPage404(){
			$this->view->generate('404_view.php', 'template_view.php');
		}
	}