<?php  
  session_start();
  require 'mysql.php';
  include 'header.php';
  $postid = $_REQUEST['postid'];
  if(!isset($postid)){
    echo "Bad Request";
    die();
  }
function handle_edit_post($postid){
    $title = $_POST['title'];
    $text = $_POST['text'];
    $nocsrftoken = $_POST["nocsrftoken"];
    $sessionnocsrftoken = $_SESSION["nocsrftoken"];
    if (isset($title) and isset($text) ){
	if(!isset($nocsrftoken) or ($nocsrftoken!=$sessionnocsrftoken)){
	echo "Cross-site request forgery is detected!";
	die();
        }
    if(edit_post($title,$text,$postid))
	echo "post edited";
    else
	echo "Cannot cannot edit the post";
    }
  }
handle_edit_post($postid);
$rand = bin2hex(openssl_random_pseudo_bytes(16));
  $_SESSION["nocsrftoken"] = $rand;
?>
<form action="edit.php?postid=<?php echo $postid; ?>" method="POST" class="form login">
  <input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
  Title : <input type="text" name="title" required/><br>
  Content : <textarea name="text" required cols="100" rows="10"></textarea><br>
  <button class="button" type="submit">Post changes</button>
</form>
<a href="user.php"> Click here to go to Main page</a>
