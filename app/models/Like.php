<?php
namespace app\models;
/**
*  Like model, used to Like post data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Like extends \app\core\Model
{
    public $post_id;
    public $user_id;

    public function __construct()
    {
        parent::__construct();
    }

    // getters and setters
    public function getPostId()
    {
        return $this->post_id;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // CRUD functions



    // read

    public function getByPostId($post_id){
        $sql = "SELECT * FROM likes WHERE post_id = :post_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Like');
        return $stmt->fetchAll();
    }

    // get likes for a post and user
    public function getLike($post_id, $user_id){
        $sql = "SELECT * FROM likes WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Like');
        return $stmt->fetch();
    }

    // insert
    public function insert(){
        $sql = "INSERT INTO likes (post_id, user_id) VALUES (:post_id, :user_id)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
    }

    // delete
    public function delete($post_id, $user_id){
        $sql = "DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

}
    