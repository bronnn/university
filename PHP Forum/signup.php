 <?php 
include 'inc/templates/header.php'; 
include 'config.php';
?>



<link href="inc/css/login.css" rel="stylesheet">

<?php
   
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    # If form hasn't been posted, display it
    echo '<div class="login">
          <div class="login-triangle"></div>          
          <h2 class="login-header">Sign Up</h2>
          <form class="login-container" method="POST" action="signup.php">
                <p><input name="username" type="text" placeholder="Username"></p>
                <p><input name="password" type="password" placeholder="Password"></p>
                <p><input name="password2" type="password" placeholder="Confirm Password"></p>
                <p><input type="submit" name="signup" value="Sign Up"></p>
           </form>';
} else {
  # DO THE DATABASE STUFF

    # If all the inputs are filled
	if (isSet($_POST['signup']) && isSet($_POST['username']) && isSet($_POST['password']) && isSet($_POST['password2']) && $_POST['username'] != '' && $_POST['password'] != '') {
		
		
		$pass = $_POST['password'];
		$passconfirm = $_POST['password2'];
		# Hashing passord 
		$hashed = password_hash($pass, PASSWORD_DEFAULT);
		$user = mysqli_escape_string($conn, $_POST['username']);
		$q = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='" . $user . "'");
		if (mysqli_num_rows($q) > 0) {
		    # Checks whether provided username has been taken
			$alert = 'That username is already taken.';
		}
		else if($pass != $passconfirm){
		    # Ensuring passwords provided by user match
			$alert ='Passwords dont match';
		}
		else if(strlen(user) <= 3){
			# Ensuring username is more than 3 characters
			$alert = 'Username must be at least 4 characters';
		}
		else if(srtlen($pass)< 6){
			# Ensuring password is more than 3 characters
			$alert = 'Password must be at least 6 characters';
		}
		else{
		    # Inserting username and hashed password into database
			$qq = mysqli_query($conn, "INSERT INTO `users` VALUES ('', '$user', '$hashed', '0')");
			if ($qq) {
			    # Preparing errors messages
				$alert = 'Registered successfully!';
			}else
				$alert = 'Failed to register.';
		}
	}
	
	  	    echo '<div class="login">
          <div class="login-triangle"></div>          
          <h2 class="login-header">Sign Up</h2>
          <form class="login-container" method="POST" action="signup.php">
                <p><input name="username" type="text" placeholder="Username"></p>
                <p><input name="password" type="password" placeholder="Password"></p>
                <p><input name="password2" type="password" placeholder="Confirm Password"></p>
                <p><input type="submit" name="signup" value="Sign Up"></p>
           </form>
           <div class="container">
            <h2 class="text-center alert2">'. $alert . '</h2>
    	    </div>';
           
}