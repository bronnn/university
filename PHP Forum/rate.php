<?php 
include 'inc/templates/header.php'; 


	if (isSet($_GET['id']) && isSet($_GET['rating'])) {
	    # Here I am carrying the ID of the thread as well as the rating
	    # I use this if statement to correct any incorrect user input
	    # e.g The user could edit the URL at the top to a different number other than 1-5
	    
	    # Set the id to an integer only so that any extra input e.g. SQL query will be disregarded 
		$id = $_GET['id'];
		$rating = $_GET['rating'];
		if ($rating > 5)
			$rating = 5;
		if ($rating < 1)
			$rating = 1;
		$qu = mysqli_query($conn, "SELECT * FROM `threads` WHERE `id`='" . mysqli_escape_string($conn, $id) . "'") or die(mysql_error());
		if (mysqli_num_rows($qu) > 0) {
			$info = mysqli_fetch_array($qu) or die(mysql_error());
			# This increasing the total rating of the thread and updates the count of ratings by 1
			# The reason for this is so that I can work out the average rating to display on the main page
			$new_rating = $info['totalrating']+1;
			$new_total = $info['rating']+$rating;
			$q = mysqli_query($conn, "UPDATE `threads` SET `rating`='$new_total', `totalrating`='$new_rating' WHERE `id`='$id'") or die(mysql_error());
			if ($q) {
				$msg = 'Rating Updated!.';
			}else
				$msg = 'Something went wrong updating the ratings :(';
		}
	}else
		echo 'Error.';
?>
<br><br>

<div class="container">
    <h2><?php echo $msg;?></h2>
    <?php header('Location: thread.php?id=' . $id); ?>
</div>

