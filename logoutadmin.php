<?php 
  session_start();
  include 'header.php';
  session_destroy();
?>
<p> You are logout! </p>

<a href="form.php">Login again</a> 
<a href="index.php">Index Page</a> 


