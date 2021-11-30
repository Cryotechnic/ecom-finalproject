<?php
namespace app\models;
/**
*  Post model, used to store post data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Post extends \app\core\Model
{
    public $post_id;
    public $user_id;
    public $topic_id;
    public $content;
    public $likes;
    public $pinned;
    public $created_at;
    public $updated_at;
    public $flagged;
    public $locked;

    public function __construct()
    {
        parent::__construct();
    }   

    // Getters and setters
    public function getPost_id() {
        return $this->post_id;
    }
    
    public function getUser_id() {
        return $this->user_id;
    }

    public function getTopic_id() {
        return $this->topic_id;
    }

    public function getContent() {
        return $this->content;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getPinned() {
        return $this->pinned;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function getFlagged() {
        return $this->flagged;
    }

    public function getLocked() {
        return $this->locked;
    }

    public function setPost_id($post_id) {
        $this->post_id = $post_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function setTopic_id($topic_id) {
        $this->topic_id = $topic_id;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setLikes($likes) {
        $this->likes = $likes;
    }

    public function setPinned($pinned) {
        $this->pinned = $pinned;
    }

    public function setCreated_at($created_at) {
        $this->created_at = $created_at;
    }

    public function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function setFlagged($flagged) {
        $this->flagged = $flagged;
    }

    public function setLocked($locked) {
        $this->locked = $locked;
    }

    // Getter functions
    public function getAllPosts() {
        $sql = "SELECT * FROM post";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByPostId($post_id) {
        $sql = "SELECT * FROM post WHERE post_id = :post_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Post');
        return $stmt->fetch();
    }

    public function getByUserId($user_id) {
        $sql = "SELECT * FROM post WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Post');
        return $stmt->fetchAll();
    }

    public function getByTopicId($topic_id) {
        $sql = "SELECT * FROM post WHERE topic_id = :topic_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':topic_id', $topic_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Post');
        return $stmt->fetchAll();
    }

    // CRUD functions
    public function insert() {
        $sql = "INSERT INTO post (user_id, topic_id, content, likes, pinned, created_at, updated_at, flagged, locked) VALUES (:user_id, :topic_id, :content, :likes, :pinned, :created_at, :updated_at, :flagged, :locked)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':topic_id', $this->topic_id);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':likes', $this->likes);
        $stmt->bindParam(':pinned', $this->pinned);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':flagged', $this->flagged);
        $stmt->bindParam(':locked', $this->locked);
        $stmt->execute();
    }

    public function update() {
        $sql = "UPDATE post SET content = :content, likes = :likes, pinned = :pinned, created_at = :created_at, updated_at = :updated_at, flagged = :flagged, locked = :locked WHERE post_id = :post_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':likes', $this->likes);
        $stmt->bindParam(':pinned', $this->pinned);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':flagged', $this->flagged);
        $stmt->bindParam(':locked', $this->locked);
        $stmt->bindParam(':post_id', $this->post_id);
        $stmt->execute();
    }

    public function delete($post_id) {
        $sql = "DELETE FROM post WHERE post_id = :post_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        $stmt->execute();
    }
}
    