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
    public $auth_token;

    public function __construct()
    {
        parent::__construct();
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

    // set auth_token
    public function setAuthToken($auth_token)
    {
        $this->auth_token = $auth_token;
    }

    // get auth_token
    public function getAuthToken()
    {
        return $this->auth_token;
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

    // update
    public function update()
    {
        $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET username = :username, password_hash = :password_hash, auth_token = :auth_token WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->bindParam(':auth_token', $this->auth_token);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->execute();
    }

    // update 2fa
    public function update2fa()
    {
        $sql = "UPDATE user SET auth_token = :auth_token WHERE user_id = :user_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':auth_token', $this->auth_token);
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
    
