<?php
namespace app\filters;
/**
*  Login filter, which checks if the user is an admin or not.
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
#[\Attribute]
class Admin {
    function execute() {
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']);
        if ($user->type != 'admin') { // login check
            header('Location: /Main/'); // redirect to login page if false
            return true;
        }
        return false;
    }
}