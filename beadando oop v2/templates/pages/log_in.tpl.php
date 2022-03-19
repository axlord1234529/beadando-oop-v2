<div class="container container-log-in">

    <?php
    if(Session::exists('signed_up'))
    {
        echo '<p>';                             
        echo Session::flash('signed_up');
        echo'</p>';                          
    }
    // if(!empty($errors))
    // {
    //     echo $errors;
    // }
    ?>
    <form class="login-box" action = "?page=log_in" method = "post">

      
        <h1>Log in</h1>
        <?php
            if(!empty($errors) && count($errors)==1)
            {
                echo"<p class='errors'>{$errors[0]}</p>";
            }
        ?>
        <div class="text-box">
        <input class="input-text" type="text" name="username" placeholder="Username" autocomplete="off"  >
        <?php if(!empty($errors['Username'])) echo"<p class='validation-errors'>{$errors['Username']}</p>"?>
        </div>
        
        <div class="text-box">
        <input class="input-text" type="password" name="password" placeholder="Password" autocomplete="off" >
        <?php if(!empty($errors['Password'])) echo"<p class='validation-errors'>{$errors['Password']}</p>"?>
        </div>
        <div class="tip double-tip">
            <label class="tip1" id="check-box" for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me">
                <span class="checkmark"></span>
                Remember me
            </label>
            <div class="tip2">
                <a href="#">Forgot password</a>
            </div>
        </div>
        <input  type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input class="btn btn-submit" type="submit" name="log_in" value="Sign in">
        <p class="tip tip-with-link">
        <span>Don't have an account?</span> <a href="?page=register">Sign up!</a>
        </p>
        <br>&nbsp;
        
    </form>
</div>
