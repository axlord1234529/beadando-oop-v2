<div class="container container-log-in">
<?php if(!empty($errors))
{
    foreach($errors as $e)
    {
        echo $e;
        echo "<br>";
    }
}
?>
<form class="login-box" action = "?oldal=register" method = "post">
      <h1>Register</h1>
      <div class="text-box">
      <input class="input-text" type="text" name="username" placeholder="username" id="username" value="<?php echo escape( Input::get('username')) ?>" >
       </div>
      <div class="text-box">
      <input class="input-text" type="password" name="password" placeholder="password" >
       </div>
       <div class="text-box">
      <input  class="input-text" type="password" name="password_again" placeholder="password again" >
       </div>
       <div class="text-box">
      <input class="input-text" type="text" name="name" placeholder="name" id="name" value="<?php echo escape(Input::get('name')) ?>" >
       </div>
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
      <input class="btn" type="submit" name="Registration" value="Register">
      <br>&nbsp;
</form>
</div>

    


