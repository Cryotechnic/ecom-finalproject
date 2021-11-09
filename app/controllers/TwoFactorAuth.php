<?php
namespace app\controllers;
	/**
    *  2FA class, which is used to generate QR code and verify user's code
    *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
    *  
    *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
    */
#[\app\filters\TwoFactorAuth]
class TwoFactorAuth extends \app\core\Controller
{
    public function index()
    {
        $user = new \app\models\User();
        $user = $user->get($_SESSION['username']); // get user from database

        if(isset($_POST['action'])) { // if user has submitted the form
            $user = new \app\models\User();
            $user = $user->get($_SESSION['username']);

            if(\app\core\TokenAuth6238::verify($user->getAuthToken(), $_POST['code'])){ // if code is valid
                $_SESSION['logged_in'] = true; // set session variable to reflect user is logged in
                header('Location: /Secure/index'); // redirect to secure page  
            }else{
                $this->view('TwoFactorAuth/index', 'Invalid code, please try again'); // display error message if code is invalid
            }
        } else {
            $this->view('TwoFactorAuth/index'); // display QR code if user has not submitted the form
        }
    }
}