<?php 
include '../inc/templates/header.php'; 


if ($level == 1){
    # If an admin visits this page the record for the chosen user is deleted
    if (isSet($_GET['id']) && $_GET['id'] != '') {
        
        # Gets the ID from the previous page
        $user_id = mysqli_real_escape_string($_GET['id']);
        # Uses this ID in the SQL query and then redirects back to user page
        $query = mysqli_query($conn, "DELETE FROM `forum`.`users` WHERE `users`.`user_id` = '" . mysqli_escape_string($conn, $user_id) . "'");
        header("Location:user.php");
    }
	if (isSet($_GET['threadid']) && $_GET['threadid'] != '') {
    
    # Gets the ID from the previous page
    $thread_id = mysqli_real_escape_string($_GET['threadid']);
    # Uses this ID in the SQL query and then redirects back to user page
    $query = mysqli_query($conn, "DELETE FROM `forum`.`threads` WHERE `threads`.`id` = '" . mysqli_escape_string($conn, $thread_id) . "'");
    header("Location:post.php");
}

    
}
else {
    # If the user is not an admin, do not delete the record and redirect to homepage
    header("Location: /index.php");
  	exit();
}