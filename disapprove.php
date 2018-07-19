<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $username = $_POST['username'];
  $disapprove = $_POST['disapprove'];
  if(isset($disapprove)){
	  function handle_disapprove_user($disapprove,$username){
    		if(disapprove_user($disapprove,$username))
		  echo "user disapproved";
    		else 
		  echo "error in disapproval";
    	  }
  }

handle_disapprove_user($disapprove,$username);
?>
<a href="admin.php"> Click here to go to Admin page</a>

