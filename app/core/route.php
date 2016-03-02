<?php
	class Route
	{
		//контроллер и действие по умолчанию
		static public function start(){
			$model_name = 'Article';
			$controller_name = 'Main';
			$action_name = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);

			if(!empty($routes[2])){
				$controller_name = $routes[2];
			}

			if(!empty($routes[3])){
				$route_act = explode('.', $routes[3]);
				$routes[3] = $route_act[0];
				$action_name = $routes[3];
			}

			$model_name = 'Model_' . $model_name;
			$controller_name = 'Controller_' . $controller_name;
			$action_name = 'action_' . $action_name;

			$model_file = strtolower($model_name) . '.php';
			$model_path = 'app/model/' . $model_file;

			if(file_exists($model_path)){
				include_once 'app/model/' . $model_file;
			}

			$controller_file = strtolower($controller_name) . '.php';
			$controller_path = 'app/controller/' . $controller_file;

			try{
				if(file_exists($controller_path)){
					include 'app/controller/' . $controller_file;
					$controller = new $controller_name;
					$action = $action_name;
					//var_dump($controller, $action);
					try{
						if(method_exists($controller, $action)){
							$controller->$action();
						}else{
							$controller = new Controller();
							$controller->ErrorPage404();
						}
					}catch(BadMethodCallException $e2){
						$error = 'There is an error-2: ' . $e2->getMessage() . '<br>' . $e2->getCode() . '<br>' . $e2->getLine() . '<br>' . $e2->getFile();
						die($error);
					}
				}else{
					$controller = new Controller();
					$controller->ErrorPage404();
				}
			}catch(Exception $e){
				$error = 'There is an error: ' . $e->getMessage() . '<br>' . $e->getCode() . '<br>' . $e->getLine() . '<br>' . $e->getFile();
				die($error);
			}

		}
	}