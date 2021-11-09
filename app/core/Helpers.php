<?php
namespace app\core;
/**
     *  Helper class, contains helper methods that are referenced in order parts of the project
     *  Authors: Benjamin Proulx (1973003), Ron Friedman (1926133), Vanier College 2021
     *  
     *  This code is/will be published on GitHub. The license is GPLv3. Please do not remove this comment
     */ 
class Helpers {
    // Convert a time to est
    public static function convertDateTime($datetime) {
        $date = new \DateTime($datetime, new DateTimeZone('UTC'));
        $tz = new DateTimeZone(date_default_timezone_get());
        $date->setTimezone($tz);
        return $date->format('Y-m-d H:i:sP e');
    }
}