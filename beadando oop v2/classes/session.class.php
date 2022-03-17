<?php
class session {
    public static function put($name,$value)  //Sets a sessin variable named as the first parameter and with the second parameter's value.
    {                                         //and then retunes it.
        return $_SESSION[$name] = $value;
    }

    public static function exists($name) //Checks if a session variable exists or not.
    {
        return isset($_SESSION[$name]);
    }

    public static function get($name) // Returns session variable named as the parameter. 
    {
        return $_SESSION[$name];
    }

    public static function delete($name) // Unsets the session variable named as the parameter if It exists.
    {
        if(self::exists($name))
        {
            unset($_SESSION[$name]);
        }
    }

    /*
        Flashes(Shows it once) session data.
        Manual:
        - On page1 you call Session::flash('name','String message that you want to flash')
        - On page2 you write:   if(Session::exists('name')
                                {
                                    //html tags optional
                                    echo Session::flash('name');
                                    //html tags optional
                                }
    */

    public static function flash($name,$string = '') 
    {
        if(self::exists($name))
        {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }
        else
        {
            self::put($name,$string);
        }
        return '';
    }
}