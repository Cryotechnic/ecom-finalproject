<?php
namespace app\models;
/**
*  User model, used to store user data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Topic extends \app\core\Model 
{
    public $topic_id;
    public $name;
    public $post_count;
    public $description;

    public function __construct() 
    {
        parent::__construct();
    }

    // Getters and setters
    public function getTopicId() 
    {
        return $this->topic_id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getPostCount() 
    {
        return $this->post_count;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setTopicId($topic_id) 
    {
        $this->topic_id = $topic_id;
    }

    public function setName($name) 
    {
        $this->name = $name;
    }

    public function setPostCount($post_count) 
    {
        $this->post_count = $post_count;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function getAllTopics() 
    {
        $sql = "SELECT * FROM topic";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByTopicId($topic_id) 
    {
        $sql = "SELECT * FROM topic WHERE topic_id = :topic_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':topic_id', $topic_id);
        $stmt->execute();
        $stnt0->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Topic');
        return $stmt->fetch();
    }

    // CRUD functions
    public function insert() {
        $sql = "INSERT INTO topic (name, post_count, description) VALUES (:name, :post_count, :description)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':post_count', $this->post_count);
        $stmt->bindParam(':description', $this->description);
        $stmt->execute();
        return self::$_connection->lastInsertId();
    }

    public function update() {
        $sql = "UPDATE topic SET name = :name, post_count = :post_count, description = :description WHERE topic_id = :topic_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':post_count', $this->post_count);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':topic_id', $this->topic_id);
        $stmt->execute();
    }

    public function delete($topic_id) {
        $sql = "DELETE FROM topic WHERE topic_id = :topic_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':topic_id', $topic_id);
        $stmt->execute();
    }
}