<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $username = $_POST['username'];
  $approve = $_POST['approve'];
  $disable = $_POST['disable'];
echo $approve . "---------------->" . $disable ;
  if(isset($approve) and isset($disable)){
	  function handle_approvedisable_user($username,$approve,$disable){
    		if(approvedisable_user($username,$approve,$disable))
		  echo "user approved";
    		else 
		  echo "error in approval";
    	  }
  }

handle_approvedisable_user($username,$approve,$disable);
?>
<a href="admin.php"> Click here to go to Admin page</a>
