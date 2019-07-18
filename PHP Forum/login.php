 <?php 
include 'inc/templates/header.php'; 
include 'config.php';
?>


<link href="inc/css/login.css" rel="stylesheet">
<?php
$alert="Fill in all fields";

if ($loggedin) {
  # If the user is already logged in, direct them to the homepage
	header("Location:index.php");
	exit();
}

else{
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  # If form is not posted, display it
  echo '
  <div class="login">
  <div class="login-triangle"></div>
  <h2 class="login-header">Log  In</h2>
  <form class="login-container" method="POST" action="login.php">
    <p><input name="username" type="text" placeholder="Username"></p>
    <p><input name="password" type="password" placeholder="Password"></p>
    <p><input name="login" type="submit" value="Log in"></p>
    </form>
  </div>';
}
else {
  if (isSet($_POST['login']) && isSet($_POST['username']) && isSet($_POST['password']) && $_POST['username'] != '' && $_POST['password'] != '') {
  	$pass = $_POST['password'];
  	$user = mysqli_escape_string($conn, $_POST['username']);
  	$q = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$user'");
  	if (mysqli_num_rows($q) > 0) {
  		$info = mysqli_fetch_array($q);
  		$stored = $info['password'];
  		if (password_verify($pass, $stored)) {
  			$_SESSION['username'] = $user;
  			echo $info['user_level'];
  			header("Location:all.php");
  			exit();
  			$alert = 'Logged in!';
  		}else
  		# Preparing error messages
  			$alert = 'Password was incorrect. Please try again.';
  	}else
  		$alert = 'That username was not found. Please try again.';
  }
  
  # If error in user input reshow the form along with the error message
    echo '
  <div class="login">
  <div class="login-triangle"></div>
  <h2 class="login-header">Log  In</h2>
  <form class="login-container" method="POST" action="login.php">
    <p><input name="username" type="text" placeholder="Username"></p>
    <p><input name="password" type="password" placeholder="Password"></p>
    <p><input name="login" type="submit" value="Log in"></p>
    </form>
  </div>
  <div class="container">
    <h2 class="text-center alert2">'. $alert . '</h2>
  </div>';

  
}}
?>
