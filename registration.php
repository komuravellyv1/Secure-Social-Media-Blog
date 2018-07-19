<?php 
  include 'header.php';
  require_once "formvalidator.php";
$show_form=true;
if(isset($_POST['Submit']))
{
    $validator = new FormValidator();
    $validator->addValidation("name","req","Please fill in Name");
    $validator->addValidation("email","email",
"The input for Email should be a valid email value");
    $validator->addValidation("email","req","Please fill in Email");
    if($validator->ValidateForm())
    {
        echo "<h2>Validation Success!</h2>";
        $show_form=false;
    }
    else
    {
        echo "<B>Validation Errors:</B>";

        $error_hash = $validator->GetErrors();
        foreach($error_hash as $inpname => $inp_err)
        {
          echo "<p>$inpname : $inp_err</p>\n";
        }
    }
}

if(true == $show_form)
{
?>
<html lang="en">
<head>
  <link rel="stylesheet" href="regstyle.css">
</head>
<body>
<form action="authentication.php" method="POST" class="form login">
  <fieldset >
    <legend>New User- Registration</legend>
      <div class="input-group">
        <label for="person_name">Name:</label>
        <input type="text" id="person_name" name="name" title="Please enter your name" required /> <br>
      </div>
      <div class="input-group">
        <label for="person_email">Email_address:</label>
        <input type="email" id="person_email" name="email" title="Your Email-validtext@domain.com" required /> <br>
      </div>
      <div class="input-group">
        <label for="person_username">Username:</label>
        <input type="text" id="person_username" name="username" required pattern="\w+" title="Please enter a valid username" 
		       onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');" /> <br>
      </div>
      <div class="input-group">
        <label for="person_pass">Password:</label>
        <input type="password" id="person_pass" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
               title="Password must has at least 6 characters with 1 number, 1 lowercase, and 1 UPPERCASE"
               onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');" /> <br>      
      </div>	
      <div class="input-group">
        <label for="telId">Phone number:</label>
        <input type="tel" id="telId" name="phone" title="999-999-9999" required /> <br>
      </div>
      <input type="hidden" name="approval" value=0 /> <br>
      <input type="hidden" name="enable" value=0 />
      <div class="input-group">
        <button class="button" type="submit"> Register </button>
      </div>
	<p>
	  Already a member? <a href="login.php">Sign in</a>
	</p>
	</fieldset>
</form>
</body>
</html>
<?PHP
}//true == $show_form
?>
