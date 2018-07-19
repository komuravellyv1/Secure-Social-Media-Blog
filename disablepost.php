<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $postid = $_REQUEST['postid'];
  if(!isset($postid)){
    echo "Bad Request";
    die();
  }
function handle_disable_post($postid){
    if(disable_post($postid))
	echo "Post disabled";
    else 
	echo "error in disable";
    }
handle_disable_post($postid);
?>
<a href="user.php"> Click here to go to Main page</a>
