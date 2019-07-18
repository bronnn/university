<?php 
include 'inc/templates/header.php'; 

# This page is just a simple account page
# It takes the info of the user logged in and displays it on screen
# If the user isnt logged in they wont see this page
# But if they navigate to it while not logged in it redirects them to the login page

# This SQL statement fetches all of the reads posted by user that is signed in
$threads ="";
$user = $_SESSION['username'];	
$q2 = mysqli_query($conn, "SELECT * FROM `threads` WHERE `author`='" . mysqli_escape_string($conn, $user) . "'");
if (mysqli_num_rows($q2) > 0) {
	while ($row = mysqli_fetch_array($q2)) {
	    # Loop around and append each one of the user's threads to a variable to be echoed
		$threads .= $row['user_level'] . '<a href="thread.php?id='.$row["id"].'">'.ucfirst($row["title"]).'</a><br>';
	}
}


?>

<div class="container threadbody">
    <?php
    # If the user is not logged in, it won't display the page, and gives them the option to login in
    if(!$_SESSION['username']){
        header('Location: login.php');
    }
    else {
        # Output the threads string if there are values present
        echo "<h4> My Threads </h4>";
        if(strlen($threads)){
            echo $threads;
        }
        else{
            # If the length of the thread string is 0, then the user has the option to create a new thread by following the link
            echo 'You haven\'t posted anything yet, click <a href="create_thread.php">here</a> to create a new thread';
        }
    }
    
    ?>


</div>