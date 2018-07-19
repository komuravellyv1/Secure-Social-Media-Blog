<?php 
  require 'secureauthentication.php';
  include 'header.php';
  $username = $_SESSION["username"];
  $newpassword = $_REQUEST['newpassword'];
  $nocsrftoken = $_POST["nocsrftoken"];
  if(!isset($nocsrftoken) or ($nocsrftoken!=$_SESSION['nocsrftoken'])){
	echo "cross-site request forgery is detected";
	die();
	}
  if (isset($newpassword) ){
    echo "changing password for '$username' <br>";
    if (mysql_change_users_password($username, $newpassword)){
      echo "Success!";
    }else{
      echo "Failed!";
    }
  } else{
    echo "Cannot change password: username and password is not provided";
  }
?>
<h2> Authenticated and active session!</h2>
<a href="admin.php">Admin page </a> | <a href="logoutadmin.php">Logout</a> 
