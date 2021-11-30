<?php
namespace app\controllers;
	/**
    *  Admin controller class, which is responsible for all administrator actions
    *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
    *  
    *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
    */ 

#[\app\filters\Login]
class Secure extends \app\core\Controller
{

    public function index(){
        $this->view('Secure/index');
    }

    public function createPost($topic_id){
        if(isset($_POST['action'])){
            if(isset($_POST['title']) && isset($_POST['description'])){
                $post = new \app\models\Post();
                $post->user_id = $_SESSION['user_id'];
                $post->topic_id = $topic_id;
                $post->title = $_POST['title'];
                $post->content = $_POST['description'];
                $post->likes = 0;
                $post->pinned = 0;
                $post->created_at = date('Y-m-d H:i:s');
                $post->updated_at = date('Y-m-d H:i:s');
                $post->flagged = 0;
                $post->locked = 0;
                $post->insert();
                header('Location: /Main/Topic/'.$topic_id);
            } else {
                $this->view('Secure/createPost', 'Please fill in all fields');
            }
        } else {
            $this->view('Secure/createPost');
        }
    }

    public function deletePost($post_id){
        $post = new \app\models\Post();
        $post = $post->getByPostId($post_id);
        $post->delete($post_id);
        header('Location: /Main/Topic/'.$post->topic_id);
    }

    public function editPost($post_id){
        if(isset($_POST['action'])){
            if(isset($_POST['title']) && isset($_POST['description'])){
                $post = new \app\models\Post();
                $post = $post->getByPostId($post_id);
                $post->title = $_POST['title'];
                $post->content = $_POST['description'];
                $post->updated_at = date('Y-m-d H:i:s');
                $post->update($post_id);
                header('Location: /Main/Topic/'.$post->topic_id);
            }
        } else {
            $this->view('Secure/editPost', $post_id);
        }
    }
}