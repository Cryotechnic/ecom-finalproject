<?php
namespace app\models;
/**
*  User model, used to store user data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Reply extends \app\core\Model
{
    public $reply_id;
    public $post_id;
    public $user_id;
    public $content;
    public $likes;
    public $created_at;
    public $updated_at;

    public function __construct() {
        parent::__construct();
    }

    // Getters and Setters
    public function getReplyId() {
        return $this->reply_id;
    }

    public function getPostId() {
        return $this->post_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setReplyId($reply_id) {
        $this->reply_id = $reply_id;
    }

    public function setPostId($post_id) {
        $this->post_id = $post_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    // Getter functions
    public function getAll() {
        $sql = "SELECT * FROM reply";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByReplyId($reply_id) {
        $sql = "SELECT * FROM reply WHERE reply_id = :reply_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':reply_id', $reply_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Reply');
        return $stmt->fetch();
    }

    public function getByPostId($post_id) {
        $sql = "SELECT * FROM reply WHERE post_id = :post_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Reply');
        return $stmt->fetchAll();
    }

    public function getByUserId($user_id) {
        $sql = "SELECT * FROM reply WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Reply');
        return $stmt->fetchAll();
    }

    // CRUD functions
    public function insert() {
        $sql = "INSERT INTO reply (post_id, user_id, content, likes, created_at, updated_at) VALUES (:post_id, :user_id, :content, :likes, :created_at, :updated_at)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':likes', $this->likes);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->execute();
        return self::$_connection->lastInsertId();
    }

    public function update() {
        $sql = "UPDATE reply SET post_id = :post_id, user_id = :user_id, content = :content, likes = :likes, created_at = :created_at, updated_at = :updated_at WHERE reply_id = :reply_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':reply_id', $this->reply_id);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':likes', $this->likes);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->execute();
    }

    public function delete() {
        $sql = "DELETE FROM reply WHERE reply_id = :reply_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':reply_id', $this->reply_id);
        $stmt->execute();
    }
}