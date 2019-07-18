<?php 
include 'inc/templates/header.php'; 



if(!$logged_in){
	# Ensure user is logged in before showing them all of the posts
	echo '
	<div class="container threadbody">
		<p> You must be <a href="login.php"> logged in </a> to view all posts </p>
	</div>';
}
else{
?>

<div class="allposts container">
	<h2><u>All Threads</u></h2><br><br>
	<?php $qu = mysqli_query($conn, "SELECT * FROM `threads`");
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
				  <p class="post-subtitle">'
				    .ucfirst($content). '
				  </p>
				  <p class="post-meta">
          <a class="view-thread" href="thread.php?id=' .$row["id"] .'">View Thread</a></p><hr>
			</div>';
		}
	}
	}?>