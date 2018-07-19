<?php
include 'header.php';
?>
<html>
      <h1>Update the details </h1>
<?php
  require "regularauthentication.php";
?>
 <form action="changeinfo.php" method="POST" class="form login">
	   <?php
		$rand = bin2hex(openssl_random_pseudo_bytes(16));
		$_SESSION["nocsrftoken"] = $rand;
	   ?>
		<input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
	<?php echo "Change Information for '" . $_SESSION["username"] . "'<br>"; ?>
<fieldset>
    <legend>Please enter below information to change!</legend>
      <div class="input-group">
        <label for="person_name">New name:</label>
        <input type="text" id="person_name" name="newname" title="Please enter your name" /> <br>
      </div>
      <div class="input-group">
        <label for="person_email"> New Email_address:</label>
        <input type="email" id="person_email" name="newemail" title="Your Email-validtext@domain.com" /> <br>
      </div>
      <div class="input-group">
        <label for="person_pass"> New Password:</label>
        <input type="password" id="person_pass" name="newpassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
               title="Password must has at least 6 characters with 1 number, 1 lowercase, and 1 UPPERCASE"
               onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');" /> <br>      
      </div>	
      <div class="input-group">
        <label for="telId">New Phone number:</label>
        <input type="tel" id="telId" name="newphone" title="999-999-9999" /> <br>
      </div>
      <div class="input-group">
        <button class="button" type="submit"> Update changes </button>
      </div>
	<p>
	  Discard the changes to enter again <a href="changeinfoform.php">Click here!</a>
	  Go back to main page <a href="user.php"> Click here!</a>
	</p>
	</fieldset>
          </form>
  </html>

