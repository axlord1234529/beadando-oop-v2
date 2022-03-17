<?php
if(Input::exists())
{
    if(Token::check(Input::get('token')))
    {
        $validate = new Validate();
        $validate->check($_POST,array(
            'username' => array('required' => true,'name' => 'Username'),
            'password' => array('required' => true, 'name' => 'Password')
        ));
        if($validate->passed())
        {
            $remember = (Input::get('remember_me')==='on') ? true : false;
            $user = new User();
            $login = $user->login(Input::get('username'),Input::get('password'),$remember);
            
            if($login)
            {
                Redirect::to('/beadando oop v2/index.php');
                
            }
            else
            {
                $errors = "Incorrect password or username!";
            }
        }
        else
        {
            $errors = $validate->errors();
        }
    }
}