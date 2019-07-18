<?php 
include '../inc/templates/header.php'; 


if ($level == 1){
    # Only display if user is admin
    echo '<div class="container threadbody"><h2><u>All Threads</u></h2><br><br>';
	$qu = mysqli_query($conn, "SELECT * FROM `threads`");
	if (mysqli_num_rows($qu) > 0) {
		while ($row = mysqli_fetch_array($qu)) {
			$content = $row['body'];
			# If the body is longer than 100 characters then this will shorten it when displaying on the homepage
			if (strlen($content) > 100) {
				$a = $content;
				$content = '';
				for($i=0;$i<100;$i++) {
					$content .= $a[$i];
				}
			}
			echo 
			'<div class="post-preview">
				  <h2 class="post-title">'
				    .ucfirst($row["title"]).
				  '</h2>
				  <p class="post-meta">
          <a class="view-thread" href="edit.php?threadid=' .$row["id"] .'">Edit</a>&nbsp<a class="view-thread" href="delete.php?threadid=' .$row["id"] .'">Delete</a></p><hr>
			</div>';
    
		}
	    
	}
}
else {
    # If the user is not an admin, do not edit the record and redirect to homepage
    header("Location:../index.php");
  	exit();
}
?> </div>