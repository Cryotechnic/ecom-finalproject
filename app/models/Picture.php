<?php
namespace app\models;
/**
*  Picture model, used to store picture information in the database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Picture extends \app\core\Model {

    public $picture_id;
    public $profile_id;
    public $filename;
    public $caption;

    public function __construct() {
        parent::__construct();
    }
    
    // getters and setters

    public function getPictureId() {
        return $this->picture_id;
    }
    
    public function setPictureId($picture_id) {
        $this->picture_id = $picture_id;
    }

    public function getProfileId() {
        return $this->profile_id;
    }

    public function setProfileId($profile_id) {
        $this->profile_id = $profile_id;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function setFilename($filename) {
        $this->filename = $filename;
    }

    public function getCaption() {
        return $this->caption;
    }

    public function setCaption($caption) {
        $this->caption = $caption;
    }

    // get all
    public function getAll() {
        $sql = "SELECT * FROM picture ORDER BY picture_id DESC";
        $result = self::$_connection->query($sql);
        $result->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture');
        return $result->fetchAll();
    }

    public function getAllFromProfile($profile_id) {
        $sql = "SELECT * FROM picture WHERE profile_id = :profile_id ORDER BY picture_id DESC";
        $result = self::$_connection->prepare($sql);
        $result->bindParam(':profile_id', $profile_id);
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture');
        return $result->fetchAll();
    }

    // get one
    public function get($picture_id) {
        $sql = "SELECT * FROM picture WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $picture_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Picture');
        return $stmt->fetch();
    }

    //insert 
    public function insert() {
        $sql = "INSERT INTO picture (profile_id, filename, caption) VALUES (:profile_id, :filename, :caption)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':profile_id', $this->profile_id);
        $stmt->bindParam(':filename', $this->filename);
        $stmt->bindParam(':caption', $this->caption);
        $stmt->execute();
    }

    // update
    public function update() {
        $sql = "UPDATE picture SET profile_id = :profile_id, filename = :filename, caption = :caption WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':profile_id', $this->profile_id);
        $stmt->bindParam(':filename', $this->filename);
        $stmt->bindParam(':caption', $this->caption);
        $stmt->bindParam(':picture_id', $this->picture_id);
        $stmt->execute();
    }

    //delete
    public function delete() {
        $sql = "DELETE FROM picture WHERE picture_id = :picture_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':picture_id', $this->picture_id);
        $stmt->execute();
    }
}