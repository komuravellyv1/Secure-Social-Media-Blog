<?php
  session_start();
  require 'mysql.php';
  include 'header.php';
  if (isset($_POST["username"]) and isset($_POST["password"]))
{
	$name = $_POST["name"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$phone = $_POST["phone"];
	$approval = 0;
	$enable = 0;

	if (mysql_reguser_secure($name,$username,$email,$password,$phone,$approval,$enable)){
	      $_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
	      $_SESSION["username"] = $_POST["username"];
	      header("Refresh:0; url=thankyou.php");
}
    	else{
	     echo "<script>alert('registration failed');</script>"; 
	     header("Refresh:0; url=index.php");
   	    }
}
else{
}
?>

