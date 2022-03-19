<?php
if (Input::exists("post")){

    if(Token::check(Input::get('token'))){

    
        $email = $_POST['email'] ;
        $subject = $_POST['subject'] ;
        $message = $_POST['message'] ;
        $residence = $_POST['residence'];
        $headers = "From: ".$email.", ".$residence;
        if(mail("sanyi1234529@gmail.com",$subject,$message,$headers)){
            Session::flash('contact','E-mail has been sent!');
        }else{
            Session::flash('contact','Something went wrong!');
        }
    }
}              