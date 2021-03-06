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
                $this->view('Main/register', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Username already in use</div>');
            } else {
                $user->insert(); // Hashing here
                $user = $user->get($_POST['username']);
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->username;
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;
                if($user->type == 'admin') {
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }
                header('Location: /Main/index');
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

            if($user != false && password_verify($_POST['password'], $user->password_hash) && $user->banned == 0) {
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['username'] = $user->username;

                $user = new \app\models\User();
                $user = $user->get($_SESSION['username']);
                // redirect if user has 2fa enabled
                $_SESSION['logged_in'] = true;
                $_SESSION['user'] = $user;
                if($user->type == 'admin') {
                    $_SESSION['admin'] = true;
                } else {
                    $_SESSION['admin'] = false;
                }
                header('Location: /Main/index');
            } else {
                // if username or password is incorrect, redirect to login and display error
                $this->view('Main/login', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div>');
            }
        }
        else {
            $this->view('Main/login'); // if no post data, display login page
        }
    }

    public function topic($topic_id){
        $this->view('Main/topic', $topic_id);
    }

    public function post($post_id){
        $this->view('Main/post', $post_id);
    }

    public function user($user_id){
        $this->view('Main/user', $user_id);
    }

    // Logs out the user by destroying the session variables
    public function logout() {
        session_destroy();
        header('Location: /Main/index');
    }
}