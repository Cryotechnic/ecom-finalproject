<?php 
// Initialize the application
session_start();
include('core/autoload.php');
require("core/phpqrcode/qrlib.php");
define('BASE', "http://" . $_SERVER['SERVER_NAME']);