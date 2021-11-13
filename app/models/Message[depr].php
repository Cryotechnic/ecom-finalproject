<?php
namespace app\models;
/**
*  Message model, represents the messages table in the database
*  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
*  
*  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
*/ 
class Message extends \app\core\Model{ 

    public $message_id;
    public $sender;
    public $receiver;
    public $message;
    public $timestamp;
    public $read_status;
    public $private_status;

    public function __construct(){
        parent::__construct();
    }

    // getters and setter
    public function setMessageId($message_id){
        $this->message_id = $message_id;
    }
    
    public function getMessageId(){
        return $this->message_id;
    }

    public function setSender($sender){
        $this->sender = $sender;
    }

    public function getSender(){
        return $this->sender;
    }

    public function setReceiver($receiver){
        $this->receiver = $receiver;
    }

    public function getReceiver(){
        return $this->receiver;
    }

    public function setMessage($message){
        $this->message = $message;
    }

    public function getMessage(){
        return $this->message;
    }

    public function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }

    public function getTimestamp(){
        return $this->timestamp;
    }

    public function setReadStatus($read_status){
        $this->read_status = $read_status;
    }

    public function getReadStatus(){
        return $this->read_status;
    }

    public function setPrivateStatus($private_status){
        $this->private_status = $private_status;
    }

    public function getPrivateStatus(){
        return $this->private_status;
    }

    public function getAll(){
        $sql = "SELECT * FROM message";
        $stmt = self::$_connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // get from message id
    public function getFromMessageId($message_id){
        $sql = "SELECT * FROM message WHERE message_id = :message_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':message_id', $message_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Message');
        return $stmt->fetch();
    }

    // get all messages from receiver
    public function getAllFromReceiver($receiver){
        $sql = "SELECT * FROM message WHERE receiver = :receiver ORDER BY message_id DESC";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':receiver', $receiver);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Message');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // insert
    public function insert(){
        $sql = "INSERT INTO message (sender, receiver, message, timestamp, read_status, private_status) VALUES (:sender, :receiver, :message, :timestamp, :read_status, :private_status)";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':sender', $this->sender);
        $stmt->bindParam(':receiver', $this->receiver);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':timestamp', $this->timestamp);
        $stmt->bindParam(':read_status', $this->read_status);
        $stmt->bindParam(':private_status', $this->private_status);
        return $stmt->execute();
    }

    // update
    public function update(){
        $sql = "UPDATE message SET sender = :sender, receiver = :receiver, message = :message, timestamp = :timestamp, read_status = :read_status, private_status = :private_status WHERE message_id = :message_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':sender', $this->sender);
        $stmt->bindParam(':receiver', $this->receiver);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':timestamp', $this->timestamp);
        $stmt->bindParam(':read_status', $this->read_status);
        $stmt->bindParam(':message_id', $this->message_id);
        $stmt->bindParam(':private_status', $this->private_status);
        return $stmt->execute();
    }

    // delete
    public function delete(){
        $sql = "DELETE FROM message WHERE message_id = :message_id";
        $stmt = self::$_connection->prepare($sql);
        $stmt->bindParam(':message_id', $this->message_id);
        return $stmt->execute();
    }
}