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

    public function createTopic(){
        if(isset($_POST['action'])){
            if(isset($_POST['title']) && isset($_POST['description'])){
                $topic = new \app\models\Topic();
                $topic->name = $_POST['title'];
                $topic->description = $_POST['description'];
                $topic->insert();
                header('Location: /Main/index');
            } else {
                $this->view('Admin/createTopic', 'Please fill in all fields');
            }
        } else {
            $this->view('Admin/createTopic');
        }
    }

    // delete a topic
    public function deleteTopic($topicId){
        $topic = new \app\models\Topic();
        $topic = $topic->getByTopicId($topicId);
        $topic->delete($topic_id);
        header('Location: /Main/index');
    }

}