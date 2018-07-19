<?php 
  require 'secureauthentication.php';
  include 'header.php';
?>
<html>	
<h2> Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
<h1> Administration of my Blog </h1>
<ul>
<li> <a href="index.php"> Home  |</a> </li>
</ul>

<?php
  echo "Current time: " . date("Y-m-d h:i:sa");
  show_regular_users();
?>
</html>

<a href="changepasswordform.php">Change password</a>
<a href="logoutadmin.php">Logout</a> 

