<?php
namespace app\controllers;
	/**
    *  Main controller class, which is responsible for the main page, including login, registration and 2FA
    *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
    *  
    *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
    */ 
class Main extends \app\core\Controller
{
    public function index(){
        $myUser = new \app\models\User();
        
        $results = $myUser->getAll();

        $this->view('Main/index',$results);
    }

    // Registers user by creating a new user in the database with the given username and password
    public function register() {
        if(isset($_POST['action']) && $_POST['password'] == $_POST['password_confirm']) {
            $user = new \app\models\User();

            $user->username = $_POST['username'];
            $user->password = $_POST['password'];

            // Check if the username is already taken
            if($user->get($_POST['username'])){
                $this->view('Main/register', 'Username already in use');
            } else {
                $user->insert(); // Hashing here
                $user = $user->get($_POST['username']);
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->username;
                $_SESSION['logged_in'] = true;
                header('Location: /Secure/Create');
            }
        } else { 
            $this->view('Main/register');
        }
    }

    // Logs in the user by checking if the username and password hash match the ones in the database
    public function login() {
        if(isset($_POST['action'])) {
            $user = new \app\models\User();
            $user = $user->get($_POST['username']);

            if($user != false && password_verify($_POST['password'], $user->password_hash)) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->username;

                $user = new \app\models\User();
                $user = $user->get($_SESSION['username']);
                // redirect if user has 2fa enabled
                if($user->getAuthToken() == ""){
                    // if user has no auth token, redirect to index
                    $_SESSION['logged_in'] = true;
                    header('Location: /Secure/index');
                } else {
                    // if user has auth token, redirect to 2fa
                    header('Location: /TwoFactorAuth/index');
                }
            } else {
                // if username or password is incorrect, redirect to login and display error
                $this->view('Main/login', 'Wrong username or password combination!');
            }
        }
        else {
            $this->view('Main/login'); // if no post data, display login page
        }
    }

    // Makes QR Code for 2FA
    public function makeQRCode() {
        $data = $_GET['data'];
        \QRcode::png($data);
    }

    // Sets up 2FA for the user by generating a random token and saving it to the database
    #[\app\filters\Login]
    public function setup2fa(){
        if(isset($_POST['action'])){
            $currentcode = $_POST['currentCode'];
            if(\app\core\TokenAuth6238::verify(
                $_SESSION['secretkey'],$currentcode)){
                //the user has verified their proper 2-factor authentication setup
                $user = new \App\models\User();
                $user = $user->get($_SESSION['username']);
                $user->auth_token = $_SESSION['secretkey'];
                $user->update2fa();
                header('location:'.BASE.'/Secure/Profile/index');
            }else{
                header('location:'.BASE.'/Main/setup2fa?error=token not verified!'); //reload
            }
        }else{
            // generate a random token
            $secretkey = \app\core\TokenAuth6238::generateRandomClue();
            $_SESSION['secretkey'] = $secretkey;
            $url = \App\core\TokenAuth6238::getLocalCodeUrl(
                $_SESSION['username'],
                'localhost',
                $secretkey,
                'Social Media Application');
            $this->view('Main/setup2fa', $url);
        }
    }

    // Disables 2FA for the user by removing the token from the database
    #[\app\filters\Login]
    public function disable2fa() {
        $user = new \App\models\User();
        $user = $user->get($_SESSION['username']);
        $user->auth_token = "";
        $user->update2fa();
        header('location:'.BASE.'/Secure/Profile/index');
    }
}