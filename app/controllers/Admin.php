<?php
namespace app\controllers;
	/**
    *  Admin controller class, which is responsible for all administrator actions
    *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
    *  
    *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
    */ 

#[\app\filters\Admin]
class Admin extends \app\core\Controller
{
    public function index(){
        $this->view('Admin/index');
    }

}