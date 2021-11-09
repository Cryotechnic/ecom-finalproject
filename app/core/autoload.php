<?php
namespace app\core;
	/**
     *  autoload class, which loads all classes with a .php extension into the web-based interface
     *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
     *  
     *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
     */ 
spl_autoload_register(
	function ($class_name) { 
    	include($class_name . '.php'); 
	}
); 
