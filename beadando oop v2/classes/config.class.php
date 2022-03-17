<?php
 //include_once will throw a warning, but will not stop PHP from executing the rest of the script.
 //require_once will throw an error and will stop PHP from executing the rest of the script
Class Config{
    public static function get($path = null){
        if($path){
            $config = $GLOBALS['config'];
            $path = explode('/',$path);// Config::get('mysql/host') then I'll get Array([0]=>mysql,[1]=>host) from this line.
            foreach($path as $bit){    
                if(isset($config[$bit])){   // 2.iteration isset($GLOBALS['config'][mysql]['host'])
                    $config = $config[$bit]; //$GLOBALS['config'][mysql];
                }
            }
            return $config;
        }
        return false; 
    }
}