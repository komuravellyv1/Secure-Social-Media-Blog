<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $username = $_REQUEST['username'];

function handle_disable_user($username){
    if(disable_user($username))
	echo "user disabled";
    else 
	echo "error in disable";
    }
handle_disable_user($username);
?>
<a href="admin.php"> Click here to go to Admin page</a>
