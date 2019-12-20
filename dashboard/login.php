<?php 
   require('connection.php');
   $error='';
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = md5(mysqli_real_escape_string($db,$_POST['password'])); 

      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: index.php");
      }else {
         $error = "Username and Password is invalid.";
      }
   }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login System</title>
</head>
<body>
	<div class="login-section">
		<form method="post">
			<label>Username:</label>
			<input type="text" name="username"><br>
			<label>Password</label>
			<input type="password" name="password"><br>
			<button>Submit</button>
		</form>
		<p><?php echo $error;?></p>

	</div>

</body>
</html>