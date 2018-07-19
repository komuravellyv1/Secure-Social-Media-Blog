<h1>Add New Post</h1>
<?php 
  session_start();
  require 'mysql.php';
  include 'header.php';
  echo "Current time: " . date("Y-m-d h:i:sa");
  function handle_new_post(){
    $title = $_POST['title'];
    $text = $_POST['text'];
    $owner = $_SESSION['username'];
    $enable = 1;
    $nocsrftoken = $_POST["nocsrftoken"];
    if (isset($title) and isset($text) and isset($owner)){
	if(!isset($nocsrftoken) or ($nocsrftoken!= $_SESSION["nocsrftoken"])){
	echo "Cross-site request forgery is detected!";
	die();
        }
    if(new_post($title,$text,$owner,$enable))
	echo "New post added";
    else
	echo "Cannot add the post";
    }
  }
handle_new_post();
?>
	<form action="new.php" method="POST" class="form login">
	   <?php
		$rand = bin2hex(openssl_random_pseudo_bytes(16));
		$_SESSION["nocsrftoken"] = $rand;
	   ?>
	 	<input type="hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
  		Your Name : <input type="text" name="owner" /><br>
  		Title : <input type="text" name="title" required/><br>
  		Content : <textarea name="text" required cols="100" rows="10"></textarea><br>
		<button class="button" type="submit">Add new Post</button>
	</form>

<a href="user.php"> Click here to go to Main page</a>
