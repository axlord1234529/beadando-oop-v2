
<form class="login-box" method='post' action='?oldal=elkuld'>
       <div class="textbox2">
<label>Email:</label> <input name='email' type='text' placeholder="E-mail" required>
       </div>
<div class="textbox2">
Tárgy: <input name='subject' type='text' placeholder="Tárgy" required >
</div>
Lakhely: <br>
<label class="container">
   <input  type="radio" name="lakhely" value="Magyarország" required>Magyaroszág</input><br>
<span class="checkmark"></span>
</label>

<label class="container">
<input  type="radio" name="lakhely" value="Külföld" required>Külföld</input>
<span class="checkmark"></span>
</label>

<div class="textbox">
Üzenet:<br> <textarea name='message' rows='15' cols='40' required>

</textarea>
</div><br>
<input class="btn" type='submit'>
</form>
