<?php
namespace app\models;
/**
*  Profile model, used to store user profile data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Profile extends \app\core\Model{

   public $profile_id;
   public $user_id;
   public $first_name;
   public $middle_name;
   public $last_name;

    public function __construct(){
        parent::__construct();
    }

    //getters and setters 
    public function getProfileId(){
        return $this->profile_id;
    }

    public function setProfileId($profile_id){
        $this->profile_id = $profile_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getFirstName(){
        return $this->first_name;
    }

    public function setFirstName($first_name){
        $this->first_name = $first_name;
    }

    public function getMiddleName(){
        return $this->middle_name;
    }

    public function setMiddleName($middle_name){
        $this->middle_name = $middle_name;
    }

    public function getLastName(){
        return $this->last_name;
    }

    public function setLastName($last_name){
        $this->last_name = $last_name;
    }

    // get all profiles
    public function getAllProfiles(){
        $sql = "SELECT * FROM profile";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get profile by id
    public function getProfileById($profile_id){
        $sql = "SELECT * FROM profile WHERE profile_id = :profile_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':profile_id', $profile_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Profile');
        return $stmt->fetch();
    }

    // get profile by user id
    public function getProfileByUserId($user_id){
        $sql = "SELECT * FROM profile WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Profile');
        return $stmt->fetch();
    }

    // insert
    public function insertProfile(){
        $sql = "INSERT INTO profile (user_id, first_name, middle_name, last_name) VALUES (:user_id, :first_name, :middle_name, :last_name)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':middle_name', $this->middle_name);
        $stmt->bindParam(':last_name', $this->last_name);
        return $stmt->execute();
    }

    //update
    public function updateProfile(){
        $sql = "UPDATE profile SET user_id = :user_id, first_name = :first_name, middle_name = :middle_name, last_name = :last_name WHERE profile_id = :profile_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':middle_name', $this->middle_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':profile_id', $this->profile_id);
        return $stmt->execute();
    }

    // delete
    public function deleteProfile(){
        $sql = "DELETE FROM profile WHERE profile_id = :profile_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':profile_id', $this->profile_id);
        return $stmt->execute();
    }

    // search
    public function search($keyword){
        $sql = "SELECT * FROM profile_details WHERE first_name LIKE :keyword OR middle_name LIKE :keyword OR last_name LIKE :keyword OR username LIKE :keyword";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindValue(':keyword', '%'.$keyword.'%');
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Profile');
        return $stmt->fetchAll();
    }
}