<?php 
	# Start Session
	# Allows access to cookies only through HTTP to prevent XSS JS Attacks
	ini_set('session.cookie_httponly', true);
	session_start();

	# Create new connection to database
	$conn = mysqli_connect("localhost", "bron98", "UniCW420", "forum");

	# Handle connection errors
	if (!$conn) {
		die("Error connecting to database: " . mysqli_connect_error());
	}
	
	# Upon login set logged in to true and get the user access level
	if($_SESSION['username']){
		$logged_in = true;
		$user = $_SESSION['username'];
		$q = mysqli_query($conn, "SELECT * FROM `users` WHERE `username`='$user'");
		if (mysqli_num_rows($q) > 0) {
			$info = mysqli_fetch_array($q);
			$level = $info['user_level'];
			
		}

	}

	



?>