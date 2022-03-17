<div class="container container-log-in">
<?php if(!empty($errors))
{
    foreach($errors as $e)
    {
        // echo "<p class='validation-errors'>{$e}</p>";
        // echo "<br>";
    }
}
?>
<form class="login-box" action = "?page=register" method = "post">
      <h1>Register</h1>
      <div class="text-box">
      <input class="input-text" type="text" name="username" placeholder="Username" id="username" value="<?php echo escape( Input::get('username')) ?>" >
      <?php if(!empty($errors['Username'])) echo"<p class='validation-errors'>{$errors['Username']}</p>"?>
       </div>
      <div class="text-box">
      <input class="input-text" type="password" name="password" placeholder="Password" >
      <?php if(!empty($errors['Password'])) echo"<p class='validation-errors'>{$errors['Password']}</p>"?>
       </div>
       <div class="text-box">
      <input  class="input-text" type="password" name="password_again" placeholder="Password again" >
      <?php if(!empty($errors['Password again'])) echo"<p class='validation-errors'>{$errors['Password again']}</p>"?>
       </div>
       <div class="text-box">
      <input class="input-text" type="text" name="name" placeholder="Name" id="name" value="<?php echo escape(Input::get('name')) ?>" >
      <?php if(!empty($errors['Name'])) echo"<p class='validation-errors'>{$errors['Name']}</p>"?>
       </div>
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" >
      <input class="btn btn-register" type="submit" name="Registration" value="Register">
      <p class="tip tip-with-link">
        <span>Already have an account?</span> <a href="?page=log_in">Log in!</a>
        </p>
      <br>&nbsp;
</form>
</div>

    


