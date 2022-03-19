
<form class="login-box" method='post' action='?page=contact'>
<?php
if(Session::exists('contact'))
    {
        echo '<p class="flash">';                             
        echo Session::flash('contact');
        echo'</p>';                          
    }
?>
       <div class="textbox2">
<label>Email:</label> <input name='email' type='text' placeholder="e-mail" required>
       </div>
<div class="textbox2">
Subject: <input name='subject' type='text' placeholder="subject" required >
</div>

Residence: <br>
<label class="container">
   <input  type="radio" name="residence" value="Hungary" required>Hungary</input><br>
</label>

<label class="container">
<input  type="radio" name="residence" value="Abroad" required>Abroad</input>
</label>

<div class="textbox">
Message:<br> <textarea name='message' rows='15' cols='40' required>

</textarea>
</div><br>
<input  type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<input class="btn" type='submit'>
</form>
