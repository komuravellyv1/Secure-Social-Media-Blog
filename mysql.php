<?php
  $mysqli = new mysqli('localhost', 'spsecad' /*Database username*/,
                                    'Aruna@03'  /*Database password*/, 
                                    'venky_secad_project' /*Database name*/);

  if ($mysqli->connect_error) {
      die('Connect Error (' . $mysqli->connect_errno . ') '
              . $mysqli->connect_error);
  }
  function mysql_checklogin_secure ($username, $password) {
    global $mysqli;
    $prepared_sql = "SELECT * FROM users where username= ?"
    . " and password=password(?);";
    if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    $stmt->bind_param("ss", htmlspecialchars($username),htmlspecialchars($password));
    if(!$stmt->execute()) echo "Execute Error";
    if(!$stmt->store_result()) echo "Store_result Error";
    if ($stmt->num_rows == 1) return TRUE;
    return FALSE;
}
function mysql_checklogin_secure_rusers ($username, $password) {
    global $mysqli;
    $prepared_sql = "SELECT * FROM rusers where username= ?"
    . " and password=password(?) and approval=1 and enable=1;";
    if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    $stmt->bind_param("ss", htmlspecialchars($username),htmlspecialchars($password));
    if(!$stmt->execute()) echo "Execute Error";
    if(!$stmt->store_result()) echo "Store_result Error";
    if ($stmt->num_rows == 1) return TRUE;
    return FALSE;
}
function mysql_reguser_secure ($name, $username, $email, $password, $phone, $approval, $enable) {
    global $mysqli;
    $prepared_sql = "INSERT into rusers (name,username,email,password,phone,approval,enable) VALUES(?,?,?,password(?),?,?,?);";
    if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("sssssii", htmlspecialchars($name),htmlspecialchars($username),htmlspecialchars($email),htmlspecialchars($password),htmlspecialchars($phone),$approval,$enable);
   if(!$stmt->execute()) {echo "Execute Error-username exists"; return FALSE;}
   return TRUE;
}


function mysql_change_users_password($username, $newpassword) {
    global $mysqli;
    $prepared_sql = "UPDATE users SET password=password(?) WHERE username= ?";
    if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
    $stmt->bind_param("ss", htmlspecialchars($newpassword), htmlspecialchars($username));
    if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
    return TRUE;
}
function mysql_change_users_info($newname, $newpassword, $newemail, $newphone, $username){
    global $mysqli;
    $prepared_sql = "UPDATE rusers SET name=?,password=password(?),email=?,phone=? WHERE username= ?";
    if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
    $stmt->bind_param("sssss", $newname, $newpassword, $newemail, $newphone, $username);
    if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
    return TRUE;
}
function show_posts(){
   global $mysqli;
   $sql = "SELECT * FROM posts WHERE enable=1";
   $result = $mysqli->query($sql);
   if($result->num_rows> 0) {
     while($row = $result->fetch_assoc()) {
	$postid = $row["postid"];
	echo "<h3>Post " . $postid . " - " .$row["title"]. "</h3>";
	echo $row["text"] . "<br>";
	echo "<a href='comment.php?postid=$postid'>";
	$sql = "SELECT * FROM comments WHERE postid='$postid';";
	$comments = $mysqli->query($sql);
	if($comments->num_rows>0){
   	   echo $comments->num_rows . " comments </a>";
	}else{
           echo "Post your first comment </a>";
	}
      }
    }
   else{ echo "No post in this blog yet <br>";}
}
function show_posts_user($username){
   global $mysqli;
   $sql = "SELECT * FROM posts WHERE owner=\"" . $username . "\"";
   $result = $mysqli->query($sql);
   if($result->num_rows> 0) {
     while($row = $result->fetch_assoc()) {
	$postid = $row["postid"];
	echo "<h3>Post " . $postid . " - " .$row["title"]. "</h3>";
	echo $row["text"] . "<br>";
	echo "<a href='comment.php?postid=$postid'>";
	$sql = "SELECT * FROM comments WHERE postid='$postid';";
	$comments = $mysqli->query($sql);
	if($comments->num_rows>0){
   	   echo $comments->num_rows . " comments </a>";
	}else{
           echo "Post your first comment </a> <br>";
	}
	echo "<a href='edit.php?postid=$postid'>edit post </a> <br>";
	echo "<a href='delete.php?postid=$postid'>delete post </a><br>";
	echo "<a href='disablepost.php?postid=$postid'>Disable post </a>";
      }
    }
   else{ echo "No post in this blog yet <br>";}
}
function disable_post($postid){
   global $mysqli;
   $prepared_sql = "UPDATE posts SET enable=0 WHERE postid=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("i", $postid);
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function show_posts_admin(){
   global $mysqli;
   $sql = "SELECT * FROM posts";
   $result = $mysqli->query($sql);
   if($result->num_rows> 0) {
     while($row = $result->fetch_assoc()) {
	$postid = $row["postid"];
	echo "<h3>Post " . $postid . " - " .$row["title"]. "</h3>";
	echo $row["text"] . "<br>";
	echo "<a href='edit.php?postid=$postid'>edit post </a>";
	echo "<a href='delete.php?postid=$postid'>delete post </a>";
      }
    }
   else{ echo "No post in this blog yet <br>";}
}
function show_regular_users(){
   global $mysqli;
   $sql = "SELECT * FROM rusers";
   $result = $mysqli->query($sql);
   if($result->num_rows> 0) {
     echo"<h2> List of regular users registred";
     while($row = $result->fetch_assoc()) {
	$username = $row["username"];
	$name=$row["name"];
	$email=$row["email"];
	echo "<h3>UserName: " . $username . " - Name: " .$row["name"]. "- Email: " . $email . "</h3>";
?>
<form action="approve.php" method="POST" class="form login">
<div>
<input type="hidden" name="username" value="<?php echo $username; ?>">
Approve:<input type="checkbox" name="approve" value="1">
enable:<input type="checkbox" name="enable" value="1">
</div>
<button class="button" type="submit">submit</button>
</form>
<form action="approvedisable.php" method="POST" class="form login">
<div>
<input type="hidden" name="username" value="<?php echo $username; ?>">
Approve:<input type="checkbox" name="approve" value="1">
Disable:<input type="checkbox" name="disable" value="0">
</div>
<button class="button" type="submit">submit</button>
</form>
<form action="disapprove.php" method="POST" class="form login">
<div>
<input type="hidden" name="username" value="<?php echo $username; ?>">
Disapprove:<input type="checkbox" name="disapprove" value="0">
</div>
<button class="button" type="submit">submit</button>
</form>

<?php
      }
    }
   else{ echo "No users in this blog yet <br>";}
}
function new_post($title,$text,$owner,$enable){
	global $mysqli;
   $prepared_sql = "INSERT into posts (title,text,owner,enable) VALUES (?,?,?,?);";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
$stmt->bind_param("sssi", htmlspecialchars($title), htmlspecialchars($text),htmlspecialchars($owner),$enable);
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}

function display_comments($postid){
   global $mysqli;
   echo "Comments for Postid= $postid <br>";
   $prepared_sql = "select title, content from comments where postid=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param('i', $postid);
   if(!$stmt->execute()) echo "Execute failed ";
   $title = NULL;
   $content = NULL;
   if(!$stmt->bind_result($title,$content)) echo "Binding failed ";
   $num_rows = 0;
   while($stmt->fetch()){ 
	echo "Comment title:" . htmlentities($title) . "<br>";
	echo htmlentities($content) . "<br>";
	$num_rows++;
   } 
   if($num_rows==0) echo "No comment for this post. Please post your comment";
}

function new_comment($postid,$title,$content,$commenter){
   global $mysqli;
   $prepared_sql = "INSERT into comments (title,content,commenter,postid) VALUES (?,?,?,?);";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("sssi", htmlspecialchars($title), htmlspecialchars($content), htmlspecialchars($commenter), $postid);
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function edit_post($title,$text,$postid){
   global $mysqli;
   $prepared_sql = "UPDATE posts SET title=?,text=? WHERE postid=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("ssi", htmlspecialchars($text), htmlspecialchars($title), $postid);
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function delete_post($postid){
   global $mysqli;
   $prepared_sql = "DELETE from posts WHERE postid=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("i", $postid);
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function approve_user($approve,$enable,$username){
   global $mysqli;
   $prepared_sql = "UPDATE rusers SET approval=?,enable=? WHERE username=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("iis", $approve,$enable,htmlspecialchars($username));
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function approvedisable_user($username,$approve,$disable){
   global $mysqli;
   $prepared_sql = "UPDATE rusers SET approval=?,enable=? WHERE username=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("sii", $approve,$disable,htmlspecialchars($username));
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function disapprove_user($disapprove,$username){
   global $mysqli;
   $prepared_sql = "UPDATE rusers SET approval=? WHERE username=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("is", $disapprove,htmlspecialchars($username));
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   $sql = "DELETE FROM rusers WHERE approval='$disapprove' and username='$username';";
   $result = $mysqli->query($sql);
   return TRUE;
}
function enable_user($username){
   global $mysqli;
   $prepared_sql = "UPDATE rusers SET enable=1 WHERE username=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("s", htmlspecialchars($username));
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function disable_user($username){
   global $mysqli;
   $prepared_sql = "UPDATE rusers SET enable=0 WHERE username=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param("s", htmlspecialchars($username));
   if(!$stmt->execute()) {echo "Execute Error"; return FALSE;}
   return TRUE;
}
function display_singlepost($postid){
   global $mysqli;
   echo "Posts for Postid= $postid <br>";
   $prepared_sql = "select title, text from posts where postid=?;";
   if(!$stmt = $mysqli->prepare($prepared_sql))
	echo "Prepared Statement Error";
   $stmt->bind_param('i', $postid);
   if(!$stmt->execute()) echo "Execute failed ";
   $title = NULL;
   $text = NULL;
   if(!$stmt->bind_result($title,$text)) echo "Binding failed ";
   $num_rows = 0;
   while($stmt->fetch()){ 
	echo "Comment title:" . htmlentities($title) . "<br>";
	echo htmlentities($text) . "<br>";
	$num_rows++;
   } 
   if($num_rows==0) echo "No comment for this post. Please post your comment";
}

?>

