<?php
namespace app\models;
/**
*  Like Picture model, used for storing likes for pictures
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Picture_like extends \app\core\Model{
    public $picture_id;
    public $profile_id;
    public $timestamp;
    public $status;

    public function __construct(){
        parent::__construct();
    }

    // getters and setters

    public function getPicture_id(){
        return $this->picture_id;
    }

    public function setPicture_id($picture_id){
        $this->picture_id = $picture_id;
    }

    public function getProfile_id(){
        return $this->profile_id;
    }

    public function setProfile_id($profile_id){
        $this->profile_id = $profile_id;
    }

    public function getTimestamp(){
        return $this->timestamp;
    }

    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    // get all likes for a picture
    public function getLikes($picture_id){
        $sql = "SELECT * FROM picture_like WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $picture_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture_like');
        return $stmt->fetchAll();
    }

    // see if a profile has liked a picture
    public function hasLiked($picture_id, $profile_id){
        $sql = "SELECT * FROM picture_like WHERE picture_id = :picture_id AND profile_id = :profile_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $picture_id);
        $stmt->bindParam(':profile_id', $profile_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture_like');
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // get likes count
    public function getLikeCount($picture_id){
        $sql = "SELECT COUNT(*) AS likes FROM picture_like WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $picture_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture_like');
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // insert
    public function insert(){
        $sql = "INSERT INTO picture_like (picture_id, profile_id, timestamp, status) VALUES (:picture_id, :profile_id, :timestamp, :status)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $this->picture_id);
        $stmt->bindParam(':profile_id', $this->profile_id);
        $stmt->bindParam(':timestamp', $this->timestamp);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
    }

    // update
    public function update(){
        $sql = "UPDATE picture_like SET picture_id = :picture_id, profile_id = :profile_id, timestamp = :timestamp, status = :status WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $this->picture_id);
        $stmt->bindParam(':profile_id', $this->profile_id);
        $stmt->bindParam(':timestamp', $this->timestamp);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
    }

    // delete
    public function delete(){
        $sql = "DELETE FROM picture_like WHERE picture_id = :picture_id AND profile_id = :profile_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $this->picture_id);
        $stmt->bindParam(':profile_id', $this->profile_id);
        $stmt->execute();
    }

}