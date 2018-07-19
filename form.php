<?php
include 'header.php';
?>
<html>	
      <h1>Admin-Login Credentials</h1>
          <form action="admin.php" method="POST" class="form login">
                Username:<input type="text" class="text_field" name="username" required pattern="\w+" title="Please enter a valid username" 
				onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');" /> <br>
                Password: <input type="password" class="text_field" name="password" /> <br>
                <button class="button" type="submit">
                  Login
                </button>
          </form>
	<a href="index.php"> Click here to go to Index page</a>
  </html>


