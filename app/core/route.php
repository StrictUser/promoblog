<?php
	class Route
	{
		//контроллер и действие по умолчанию
		static function start(){
			$controller_name = 'Main';
			$action_name = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);

			if(!empty($routes[1])){
				$controller_name = $routes[1];
			}

			if(!empty($routes[2])){
				$action_name = $routes[2];
			}

			$model_name = 'Model_' . $controller_name;
			$controller_name = 'Controller_' . $controller_name;
			$action_name = 'action_' . $action_name;

			$model_file = strtolower($model_name) . '.php';
			$model_path = "app/model/" . $model_file;
			if(file_exists($model_path)){
				include 'app/model/' . $model_file;
			}

			$controller_file = strtolower($controller_name) . '.php';
			$controller_path = "app/controller" . $controller_file;
			if(file_exists($controller_path)){
				include "app/controller" . $controller_file;
			}else{
				throw new Exception('Cannot include controller file');
				Route::ErrorPage404();
			}
		}

		function ErrorPage404(){
			$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
			header('HTTP/1.1 404 Not Found');
				header("Status: 404 Not Found");
				header('Location:' . $host . '404');
		}
	}