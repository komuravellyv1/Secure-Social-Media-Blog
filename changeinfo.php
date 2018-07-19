<?php 
  include 'header.php';
  require 'regularauthentication.php';
  $username = $_SESSION["username"];
  $newname = $_REQUEST['newname'];
  $newemail = $_REQUEST['newemail'];
  $newphone = $_REQUEST['newphone'];
  $newpassword = $_REQUEST['newpassword'];
  $nocsrftoken = $_POST["nocsrftoken"];
  if(!isset($nocsrftoken) or ($nocsrftoken!=$_SESSION['nocsrftoken'])){
	echo "cross-site request forgery is detected";
	die();
	}
  if (isset($newpassword) ){
    echo "changing details for '$username' <br>";
    if (mysql_change_users_info($newname, $newpassword, $newemail, $newphone, $username)){
      echo "Success!";
    }else{
      echo "Failed!";
    }
  } else{
    echo "Cannot change password: username and password is not provided";
  }
?>
<h2> Authenticated and active session!</h2>
<a href="user.php">Main page </a> | <a href="logout.php">Logout</a> 
