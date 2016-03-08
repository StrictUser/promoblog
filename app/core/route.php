<?php

	class Route
	{
		//контроллер и действие по умолчанию
		static public function start(){

			$controller_name = 'Main';
			$action_name = 'index';

			$routes = explode('/', $_SERVER['REQUEST_URI']);

			if($_SERVER['REQUEST_URI'] === '/promo/category/'){
				$model_name = 'Category';
			}elseif($_SERVER['REQUEST_URI'] === '/promo/'){
				$model_name = 'Article';
			}else{
				$model_name = $routes[2];
			}

			// получаем имя контроллера
			if(!empty($routes[2])){
				$controller_name = $routes[2];
			}

			// получаем имя экшена
			if(!empty($routes[3])){
				//$route_act = explode('.', $routes[3]);
				//$routes[3] = $route_act[0];
				$action_name = $routes[3];
			}

			// добавляем префиксы
			$model_name = 'Model_' . $model_name;
			$controller_name = 'Controller_' . $controller_name;
			$action_name = 'action_' . $action_name;

			// подцепляем файл с классом модели (файла модели может и не быть)
			$model_file = strtolower($model_name) . '.php';
			$model_path = 'app/model/' . $model_file;

			if(file_exists($model_path)){
				include_once 'app/model/'. $model_file;
			}

			// подцепляем файл с классом контроллера
			$controller_file = strtolower($controller_name) . '.php';
			$controller_path = 'app/controller/' . $controller_file;

			//var_dump($model_name, $controller_name, $action_name);
			//var_dump($model_file, $model_path, $controller_file, $controller_path);

			try{
				if(file_exists($controller_path)){
					$myController = strtolower(getController($controller_name));
					$myModel = strtolower(getController($model_name));
					//header('Location: /promo'.$myModel.'/'.$myController.'/');
					include 'app/controller/' . $controller_file;
					// создаем контроллер
					$controller = new $controller_name;
					$action = $action_name;
					try{
						if(method_exists($controller, $action)){
							// вызываем действие контроллера
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