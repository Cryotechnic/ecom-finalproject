<?php
namespace app\models;
/**
*  User model, used to store user data in database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class User extends \app\core\Model
{
    public $user_id;
    public $username;
    public $password;
    public $password_hash;
    public $email;
    public $type;
    public $banned;
    public $location;
    public $dob;
    public $bio;

    public function __construct()
    {
        parent::__construct();
    }

    // get email
    public function getEmail()
    {
        return $this->email;
    }

    // set email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // get type
    public function getType()
    {
        return $this->type;
    }

    // set type
    public function setType($type)
    {
        $this->type = $type;
    }

    // get banned
    public function getBanned()
    {
        return $this->banned;
    }

    // set banned
    public function setBanned($banned)
    {
        $this->banned = $banned;
    }

    // get location
    public function getLocation()
    {
        return $this->location;
    }

    // set location
    public function setLocation($location)
    {
        $this->location = $location;
    }

    // get dob
    public function getDob()
    {
        return $this->dob;
    }

    // set dob
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    // get bio
    public function getBio()
    {
        return $this->bio;
    }

    // set bio
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    // set user_id
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // get user_id
    public function getUserId()
    {
        return $this->user_id;
    }

    // set username
    public function setUsername($username)
    {
        $this->username = $username;
    }

    //get username
    public function getUsername()
    {
        return $this->username;
    }

    // set password_hash
    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }

    // get password_hash
    public function getPasswordHash()
    {
        return $this->password_hash;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM user";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // get from username
    public function get($username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
        return $stmt->fetch();
    }

    // get from user_id
    public function getById($user_id)
    {
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
        return $stmt->fetch();
    }

    // get banned users
    public function getBannedUsers()
    {
        $sql = "SELECT * FROM user WHERE banned = 1";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
        return $stmt->fetchAll();
    }
    

    // insert
    public function insert()
    {
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, password_hash) VALUES (:username, :password_hash)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->execute();
        return self::$_connection->lastInsertId();
    }

    //update 

    public function update()
    {
        $sql = "UPDATE user SET username = :username, password_hash = :password_hash, email = :email, type = :type, banned = :banned, location = :location, dob = :dob, bio = :bio WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':banned', $this->banned);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':dob', $this->dob);
        $stmt->bindParam(':bio', $this->bio);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
    }

    // update
    public function updatePassword()
    {
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password_hash = :password_hash WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
    }
    // delete
    public function delete($user_id)
    {
        $sql = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }
}
    
