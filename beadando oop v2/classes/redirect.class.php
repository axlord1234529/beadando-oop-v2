<?php
class Redirect {
    public static function to($location = null)
    {
        if($location)
        {
            if(is_numeric($location))
            {
                switch($location)
                {
                    case 404:
                        http_response_code(404);
                        include('D:\XAMPP\htdocs\beadando oop v2\templates\pages\404.tpl.php'); 
                        die();
                        
                    break;
                    case 500:
                        http_response_code(404);
                        include('D:\XAMPP\htdocs\beadando oop v2\templates\pages\500.tpl.php'); 
                        die();
                    break;
                }

            }
            header('Location: '.$location);
            exit();
        }
    }
}