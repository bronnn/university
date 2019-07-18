
<?php
    include 'inc/templates/header.php';
    
    if($logged_in){
    # Displaying the thread
    	$title = '';
    	$content = '';
    	$author = '';
    	if (isSet($_GET['id']) && $_GET['id'] != '') {
    		$id = $_GET['id'];
    		
    		# Takes in an ID depending on what link the user clicks - this is stored in a variable called $id
    		# $query - fetches all data regarding that id
    		
    		$query = mysqli_query($conn, "SELECT * FROM `threads` WHERE `id`='$id'");
    		if (mysqli_num_rows($query) > 0) {
    			$info = mysqli_fetch_array($query);
    			$title = $info['title'];
    			$content = $info['body'];
    			$author = 'By '.$info['author'];
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    			
    	

	$qq = mysqli_query($conn, "SELECT * FROM `threads` WHERE `id`='$id'");
	if (mysqli_num_rows($qq) > 0) {
	  # rating is the sum of all ratings and totalrating is the number of ratings
	  # these figures can be used to calculate the average rating
		$info = mysqli_fetch_array($qq);
		$all = $info['rating'];
		$total = $info['totalrating'];
		# If there are no ratings
		if ($all == 0 || $all == null || $total == 0 || $total == null) {
			$rating = 'No ratings. Tell us your thoughts';
		}else {
			$average = $all / $total;
			# Round the rating to 1 Decimal place
			$rating = 'Average Rating: '. round($average, 1);
		}
	}
    }
    else {
      # If the thread can't be found
      header('Location: all.php');
    }
?>

    <div class="threadbody container">
      

    <div>
      <p><?php echo $rating; 
      # Here the user can rate the threads. This sends a request to the rate page taking in the ID.
      # On the rating page the updated ratings are added to the database
      # Using FontAwesome stars to let user rate the thread
      ?></p>
      <div class="stars">
      	<a href=<?php echo 'rate.php?id='.$_GET['id'].'&rating=1'; ?>><p><i class="far fa-star"></i></p></a>
      	<a href=<?php echo 'rate.php?id='.$_GET['id'].'&rating=2'; ?>><p><i class="far fa-star"></i></p></a>
      	<a href=<?php echo 'rate.php?id='.$_GET['id'].'&rating=3'; ?>><p><i class="far fa-star"></i></p></a>
      	<a href=<?php echo 'rate.php?id='.$_GET['id'].'&rating=4'; ?>><p><i class="far fa-star"></i></p></a>
      	<a href=<?php echo 'rate.php?id='.$_GET['id'].'&rating=5'; ?>><p><i class="far fa-star"></i></p></a>
    	</div>
    	<br><br>
    </div>
    		<h1><?php echo ucfirst($title); ?></h1>
    		<p><?php echo $content; ?></p>
    		
    		<p><a href="user.php?username=<?php echo $info['author']; ?>"><?php echo $author; # Echos the author and thread info ?></a></p>
    		<hr>
    </div>


    
<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="thread.php?id=<?php echo $id;?>" method="post">
          <fieldset>
            <legend style="padding-left: 15px;">Reply</legend>
    
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" value="<?php echo $_SESSION['username'];?>" readonly class="form-control">
              </div>
            </div>
    

    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Comment</label>
              <div class="col-md-9">
                <textarea class="form-control" id="body" name="body" placeholder="Say Something Nice..." rows="5"></textarea>
              </div>
            </div>
    
            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-left">
                <button type="submit" name="send-reply" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
	</div>
</div>


<?php
    # Adding the reply to the database
    # Basic error checking to make sure form values are set and that they are not empty
    if (isSet($_POST['send-reply']) && isSet($_POST['body']) && $_POST['body'] != '' && isSet($_GET['id']) && $_GET['id'] != '') {
    	$body = mysqli_escape_string($conn, strip_tags($_POST['body']));
    	$thread = $_GET['id'];
    	$user = $_SESSION['username'];
    	$q = mysqli_query($conn, "INSERT INTO `replies` VALUES ('', '$thread', '$body', '$user')");
    	echo '<div class="container">';
    	if ($q) {
    		echo 'Reply submitted.';
    	}else
    		echo 'Failed inserting reply.';
    }
    echo '</div>';
    ?>
    	</body>
    </html>

    
    <?php
    # Fetching all the replies for given post and displaying them
    
    $replies = '';
    $qu = mysqli_query($conn, "SELECT * FROM `replies` WHERE `thread_id`='$id'");
			if (mysqli_num_rows($qu) > 0) {
				echo '<div class="container">    
				<br><h3> Replies</h3><br>';
				while ($row = mysqli_fetch_array($qu)) {
				  echo'
				  <div class="container">
            <h4 class="author">' .ucfirst($row['author']) .'</h4>
            <p>' . ucfirst($row['body']) .'</p>
            <hr>
          </div>';
				  
}
}
	} # end of rows if
    		
    		
    		
    		
    		
    		
    		
    		
    		else
    			$tid ='No threads, create one!';
    	}else
    		$tid= 'Something went wrong';
    		
?>



