<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $postid = $_REQUEST['postid'];
  if(!isset($postid)){
    echo "Bad Request";
    die();
  }
function handle_delete_post($postid){
    if(delete_post($postid))
	echo "post deleted";
    else
	echo "Cannot cannot delete the post";
    }
handle_delete_post($postid);
?>
<a href="user.php"> Click here to go to Main page</a>
