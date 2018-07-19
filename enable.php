<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $username = $_REQUEST['username'];

function handle_enable_user($username){
    if(enable_user($username))
	echo "user enabled";
    else 
	echo "error in enable";
    }
handle_enable_user($username);
?>
<a href="admin.php"> Click here to go to Admin page</a>
