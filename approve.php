<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $username = $_POST['username'];
  $approve = $_POST['approve'];
  $enable = $_POST['enable'];
  if(isset($approve) and isset($enable)){
	  function handle_approve_user($approve,$enable,$username){
    		if(approve_user($approve,$enable,$username))
		  echo "user approved";
    		else 
		  echo "error in approval";
    	  }
  }

handle_approve_user($approve,$enable,$username);
?>
<a href="admin.php"> Click here to go to Admin page</a>
