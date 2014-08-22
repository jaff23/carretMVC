<?php

class Input {

    public static function getInt ($key) {
        try {
            return filter_input(INPUT_GET, $key, FILTER_SANITIZE_NUMBER_INT);
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    public static function getString ($key) {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
    }
    
    public static function getEmail ($key) {
        return filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
    }
    
    public static function postInt ($key) {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_NUMBER_INT);
    }
    
    public static function postString ($key) {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }
    
    public static function postEmail ($key) {
        return filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }
    
    public static function getAll () {
        
        $get = array();
        foreach ($_GET as $inp) {
            $get[] = addslashes($inp);
        }
        
        return $get;
    }
}
