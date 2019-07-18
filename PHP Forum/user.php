<?php 
include 'inc/templates/header.php'; 
# This will show all the threads for a given user

	$threads = '<table><tbody>';
	if (isSet($_GET['username']) && $_GET['username'] != '') {
		$user = $_GET['username'];
		$q = mysqli_query($conn, "SELECT * FROM `threads` WHERE `author`='$user'");
		if (mysqli_num_rows($q) > 0) {
			while ($row = mysqli_fetch_array($q)) {
				# Looping around all results and adding them to a string with table elements
				$threads .= '<tr><td><a href="thread.php?tid='.$row["id"].'">'.ucfirst($row["title"]).'</td></tr>';
			}
			$threads .= '</tbody></table>';
		}else
			$na = true;
	}
	
		if (!isSet($na)) {
			# Echos the table containing all the threads
			echo '<div class="threadbody container">
			        <h2> All threads by: ' 
			        . $user . '</h2>'
			        . $threads .
					'</div>
			';
	}else
		# If the user cannot be found or has not made any posts
		echo '
		<div class="threadbody container">
		That user does not exist, or they haven\'t posted anything yet...
		</div>';
	
	
?>

