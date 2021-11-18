<?php
namespace app\filters;
/**
*  Login filter, which checks if the user is logged in or not.
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
#[\Attribute]
class Login {
    function execute() {
        if ($_SESSION['logged_in'] != true) { // login check
            header('Location: /Main/login'); // redirect to login page if false
            return true;
        }
        return false;
    }
}