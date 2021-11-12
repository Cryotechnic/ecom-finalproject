<?php
namespace app\core;
    /**
     *  Model class, which connects to the database for various operations in other files
     *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
     *  
     *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
     */ 
class Model {
    protected static $_connection = null;

    public function __construct() {
        // Creates new db connection
        $username = 'root';
        $password = '';
        $host = 'localhost';
        $dbname = 'forum';

        if(self::$_connection == null) {
            self::$_connection = new \PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        }
    }
}
