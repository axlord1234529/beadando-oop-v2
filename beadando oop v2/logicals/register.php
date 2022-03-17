<?php
//require_once 'D:\XAMPP\htdocs\beadando oop v2\includes\init.inc.php';
//isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['password_again'])&&isset($_POST['name'])
if(Input::exists()) { 
    if(Token::check(Input::get('token')))
    {
    $validate = new Validate();
    $validate->check($_POST,array(
        'username' => array( //item(rule) name must match input name in the form
            'required' => true,
            'name' => 'Username',
            'min' => 2,
            'max' => 20,
            'unique' =>'users',
            'has_characters' =>true

        ),
        'password' => array(
            'required' => true,
            'name' => 'Password',
            'min' => 6,
            'has_characters' => true
        ),
        'password_again' => array(
            'required' => true,
            'name' => 'Password again',
            'matches' => 'password'
        ),
        'name' => array(
            'required' => true,
            'name' => 'Name',
            'min' => 2,
            'max' => 50
        )
    ));
    if($validate->passed())
    {
        $user = new User();
        try{

            $user->create(array(
                'id' =>'',
                'username' => Input::get('username'),
                'password' => password_hash(Input::get('password'),PASSWORD_DEFAULT,array('cost'=>12)),
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'teams' => '1'

            ));
            Session::flash('signed_up',"You've successfully registered! Now you can sign in.");
            Redirect::to('/beadando oop v2/index.php?oldal=belepes');
        }
        catch(Exception $e)
        {
            Redirect::to(500);
            die($e->getMessage());
        }
    }else
    {
        $errors = $validate->errors();
    }
    }
}
?>