<?php

class Router
{
	private $routes;//массив в котором будут храниться маршруты
	
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	private function getURI() 
	{
		if(!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'],'/');
		}
	}
	
	//принимает управление от Front Controller
	public function run()
	{
		/*print_r($this->routes);
		echo 'Router function Run()';*/
		
		//Получить строку запроса
		$uri = $this->getURI();
		//echo $uri;
		
		//Проверить наличие такого запроса в routes.php
		foreach ($this->routes as $uriPattern => $path){
			//echo "<br>$uriPattern -> $path";
			if (preg_match("~$uriPattern~", $uri)) {
                                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); 
				//echo $internalRoute;
				$segments = explode('/', $internalRoute);
				/*echo '<pre>';
				print_r($segments);
				echo '</pre>';*/
                                //адрес каталога проекта на localhost
                                $directoryName = array_shift($segments);
                                
				$controllerName = array_shift($segments)."Controller";
				$controllerName = ucfirst($controllerName);
				//echo 'Класс ', $controllerName, '</br>';
				$actionName = "action".ucfirst(array_shift($segments));
				//echo 'Метод ', $actionName;
                                
                                //Остальное это параметры
                                $parameters = $segments;
                                /*echo '<pre>';
				print_r($parameters);
				echo '</pre>';*/
		
					
				//Подключить файл класса Controller
				$controllerFile = ROOT . '//controllers//' . 
				$controllerName . '.php';
                                
				/*echo "<br>", $controllerFile;		
				include_once($controllerFile);*/
			
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
					//echo  '<br> yes';
				}
		
				//Создать обьект, вызвать метод
				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				if ($result != null) {
					break;
				}
			}
	    }
	}
}
