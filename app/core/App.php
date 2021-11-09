<?php
namespace app\core;
	/**
    *  Main App class, which contains actions for the entire project as it is responsible for initializing the entire app
    *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
    *  
    *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
    */ 
class App{
	private $controller = 'app\\controllers\\Main'; // Set default controller value 
	private $method = 'index';
	private $params = [];

	public function __construct(){
		// Get url + parse to array
		$url = $this->parseURL();
		// Check if controller exists
		if(isset($url[0])){ 
			if(file_exists('app/controllers/' . $url[0] . '.php')){
				$this->controller = 'app\\controllers\\' . $url[0];
			}
			// Unset 0 index (Deletes controller name from memory)
			unset($url[0]);
		}
		$this->controller = new $this->controller;
		// Check if method exists
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
			}
			unset($url[1]);
		}
		// Check if params exist
		$this->params = $url ? array_values($url) : [];

		$reflection = new \ReflectionObject($this->controller);
		$controllerAttributes = $reflection->getAttributes();
		$methodAttributes = $reflection->getMethod($this->method)->getAttributes();
		// Check if controller is accessible and loads attributes
		$filters = array_values(array_filter(array_merge($controllerAttributes, $methodAttributes)));

		// Check if filters exist
		foreach($filters as $filter){
			$filter = $filter->newInstance();
			if($filter->execute())
				return;
		}
		call_user_func_array(array($this->controller, $this->method), $this->params);
	}

	// Parses url to array
	public function parseURL(){
		if(isset($_GET['url'])){
			return explode('/', 
				filter_var(
					rtrim($_GET['url'], '/'),//remove he trailing /
					 FILTER_SANITIZE_URL)
			);
		}
	}
}