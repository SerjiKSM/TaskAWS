<?php

class Router {
	
	private $routes;
		
	public function __construct(){
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	public function run(){
	
		// Get the query string
		$uri = $this->getURI();
		
		// Check this query in routes.php
		foreach ($this->routes as $uriPattern => $path){
			if(preg_match("~$uriPattern~", $uri)){
				// get the inner path of the external according to the rules
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				
				// To determine which controller, and action processes the request
				$segments = explode('/', $internalRoute);
				
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				$actionName = 'action'.ucfirst(array_shift($segments));
				
				// array parameters
				$parameters = $segments;
				
				// Connect the controller class file
 				$controlleFile = ROOT.'/controllers/'.$controllerName.'.php';
 				if(file_exists($controlleFile)){
 					include_once($controlleFile);
 				}
				
 				// Create object, calls the method
 				$controllerObject = new $controllerName;
				
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
 				if($result != null){
 					break;
 				}
				
			}
			
		}	
	
	}
		
	/**
	 * Returns request string
	 * @return string
	 */
	private function getURI(){
	
		if(!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	
	}
	
}


