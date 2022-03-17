<?php

Class Input {
    //Checks if any data exists(If input has been provided or not)
    public static function exists($type = 'post') {
        switch($type)
        {
            case 'post':
                return (!empty($_POST)) ?  true : false;
            break;
            case 'get':
                return (!empty($_GET)) ?  true : false;
            break;
            default:
                return false;
            break;
        }
    }
    // Retrives submited data the same as($_POST['username'])
    public static function get($item) {
        if(isset($_POST[$item]))
        {
            return $_POST[$item];
        }else if(isset($_GET[$item]))
        {
            return $_GET[$item];
        }
        return '';
    }
}