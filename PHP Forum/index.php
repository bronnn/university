<?php 
include 'inc/templates/header.php'; 
?>

    <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Get connected!</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="search.php" method="POST">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" name="searchtxt" class="form-control form-control-lg" placeholder="Search all Posts...">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" name="search_btn" class="btn btn-block btn-lg btn-custom">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>
    
        <div class="post-header">
            <div class="row">
                <div class="col-sm-12 text-center"><span class="tag"><a href="/"> Home</a></span><span class="tag"><a href="create_thread.php">New Thread</a></span>
                    </div>
            </div>
        </div>
    </div>
    <hr>


    <h1 class="text-center">Latest Threads</h1>
    <hr>


<div class="text-center container">
	<?php 
	$latest = '';
	$lq = mysqli_query($conn, "SELECT * FROM (SELECT * FROM `threads` ORDER BY `id` DESC LIMIT 3) t ORDER BY `id` DESC");
	if (mysqli_num_rows($lq) > 0) {
	while ($row = mysqli_fetch_array($lq)) {
		$latest .= '<div class="post-preview">
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
echo $latest;

	
	
	
	?>
	

	<a class="viewall" href="all.php"><h5> VIEW ALL THREADS </h5></a>

</div>

<?php

include 'inc/templates/footer.php'; 
?>