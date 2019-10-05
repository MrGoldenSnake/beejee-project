<?php

class Router
{
	static function start()
	{	
		// контроллер и действие по умолчанию
		$controller_name = 'tasks';
		$action_name = 'main';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// controller
		if (!empty($routes[1]))
			$controller_name = $routes[1];
		
		// action
		if (!empty($routes[2]))
		{
			if(isset($_GET) && !empty($_GET))
				$action_name = substr($routes[2], 0, strpos($routes[2],'?'));
			else
				$action_name = $routes[2];
		}
		
		$model_name = 'model_'.$controller_name;
		$controller_name = $controller_name;
		$action_name = 'action_'.$action_name;

		
		// dump('Model: '.$model_name);
		// dump('Controller: '.$controller_name);
		// dump('Action: '.$action_name);
		// die(1);
		

		/* model */
		$model_file = strtolower($model_name).'.php';
		$model_path = "app/model/".$model_file;
		if(file_exists($model_path))
			include "app/model/".$model_file;
		
		/* controller */
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "app/controller/".$controller_file;
		if(file_exists($controller_path))
			include "app/controller/".$controller_file;
		else
			Router::Error404();
		
		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller, $action))
			$controller->$action();
		else
			Router::Error404();	
	}

	public static function Error404()
	{
		echo '<div style="text-align: center;"><h1>Page not found.</h1><h2><a href="/tasks/main">Вернуться..</a></h2></div>';
    }
    
}
