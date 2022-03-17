<?php
class Token
{
    public static function generate() // Generates a token then puts it into a session variable named as you seted the_token name in the init.inc.php 
    {                                 // Returns the session variable which contains the token.
        return session::put(Config::get('session/token_name'),md5(uniqid()));
    }

    public static function check($token) // If a token has been generated(there is a session variable with the token_name set in init.inc.php) 
    {                                    // it checks if the token provided in the parameter matches the previously generated token.
        $tokenName = Config::get('session/token_name');
        if(Session::exists($tokenName)&& $token === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}