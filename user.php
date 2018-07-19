<?php 
  require 'regularauthentication.php';
?>	
<html lang="en">
  <head>
	<meta charset="UTF-8">
	<!-- Web Fonts -->
  	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Font Awesome CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="screen">
  </head>
<body>
<center>
<h2> Welcome <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
</center>
<!-- Navigation -->
	<header class="header">
		<nav class="navbar navbar-custom" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><img src="logo.png" alt=""></a>
				</div>

				<div class="collapse navbar-collapse" id="custom-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="user.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
						<li><a href="new.php">Create New post</a></li>
						<li><a href="changeinfoform.php">Update your details</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div><!-- .container -->
		</nav>
	</header><!-- End Navigation -->
<?php
  $username = $_SESSION['username'];
  show_posts_user($username);
?>
</body>
</html>

