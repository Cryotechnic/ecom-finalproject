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
        header("Location: /");
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
        $post = new \app\models\Post();
        $post = $post->getByPostId($post_id);
        if($post->user_id == $_SESSION['user_id']){
            if(isset($_POST['action'])){
                $post->content = $_POST['description'];
                $post->updated_at = date('Y-m-d H:i:s');
                $post->update();
                header('Location: /Main/Topic/'.$post->topic_id);
            } else {
                $this->view('Secure/editPost', $post_id);
            }
        } else {
            header('Location: /Main/Topic/'.$post->topic_id);
        }
    }

    public function reply($post_id){
        $post = new \app\models\Post();
        $post = $post->getByPostId($post_id);
        if(isset($_POST['action'])){
            if(isset($_POST['description'])){
                $reply = new \app\models\Reply();
                $reply->user_id = $_SESSION['user_id'];
                $reply->post_id = $post_id;
                $reply->content = $_POST['description'];
                $reply->created_at = date('Y-m-d H:i:s');
                $reply->updated_at = date('Y-m-d H:i:s');
                $reply->likes = 0;
                $reply->insert();
                header('Location: /Main/Post/'.$post->post_id);
            } else {
                $this->view('Secure/reply', 'Please fill in all fields');
            }
        } else {
            $this->view('Secure/reply', array('post_id' => $post_id));
        }
    }

    public function quoteReply($post_id){
        $post = new \app\models\Post();
        $post = $post->getByPostId($post_id);
        if(isset($_POST['action'])){
            if(isset($_POST['description'])){
                $reply = new \app\models\Reply();
                $reply->user_id = $_SESSION['user_id'];
                $reply->post_id = $post_id;
                $reply->content = $_POST['description'];
                $reply->created_at = date('Y-m-d H:i:s');
                $reply->updated_at = date('Y-m-d H:i:s');
                $reply->likes = 0;
                $reply->insert();
                header('Location: /Main/Post/'.$post->post_id);
            } else {
                $this->view('Secure/reply', 'Please fill in all fields');
            }
        } else {
            $this->view('Secure/reply', array('post_id' => $post_id, 'quote' => $post->content));
        }
    }

    public function deleteReply($reply_id){
        $reply = new \app\models\Reply();
        $reply = $reply->getByReplyId($reply_id);
        if($reply->user_id == $_SESSION['user_id'] || $_SESSSION['admin'] == true){
            $reply->delete($reply_id);
            header('Location: /Main/Post/'.$reply->post_id);
        }
        header('Location: /Main/Post/'.$reply->post_id);
    }

    public function editReply($reply_id){
        $reply = new \app\models\Reply();
        $reply = $reply->getByReplyId($reply_id);
        if($reply->user_id == $_SESSION['user_id']){
            if(isset($_POST['action'])){
                $reply->content = $_POST['description'];
                $reply->updated_at = date('Y-m-d H:i:s');
                $reply->update();
                header('Location: /Main/Post/'.$reply->reply_id);
            } else {
                $this->view('Secure/editReply', $reply->reply_id);
            }
        } else {
            header('Location: /Main/Post/'.$reply->post_id);
        }
    }

    public function like($post_id){
        $like = new \app\models\Like();
        $like->user_id = $_SESSION['user_id'];
        $like->post_id = $post_id;
        $like->insert();
        header('Location: /Main/Post/'.$post_id);
    }

    public function unlike($post_id){
        $like = new \app\models\Like();
        $like->delete($post_id, $_SESSION['user_id']);
        header('Location: /Main/Post/'.$post_id);
    }

    public function reportpost($post_id){
        $post = new \app\models\Post();
        $post = $post->getByPostId($post_id);
        $post->flagged = 1;
        $post->update();
        header('Location: /Main/Post/'.$post_id);
    }

    public function editProfile(){
        if(isset($_POST['action'])){
            $user = new \app\models\User();
            $user = $user->getById($_SESSION['user_id']);
            $user->dob = $_POST['date'];
            $user->location = $_POST['location'];
            $user->bio = $_POST['description'];
            $user->update();
            header('Location: /Main/user/' . $_SESSION['user_id']);
        } else {
            $this->view('Secure/editProfile');
        }
    }
}