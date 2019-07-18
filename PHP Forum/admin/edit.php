<?php
# TO DO
# Get ID from $_GET - use to pull data from database into form
# Allow to be edited and overwrite existing data

include '../inc/templates/header.php'; 

$id = $_GET['threadid'];
$errors = '';

if ($level == 1){
    # If an admin visits this page the record for the chosen thread is deleted
    
    if (isSet($_GET['threadid']) && $_GET['threadid'] != '') {
    $id = $_GET['threadid'];
    $query = mysqli_query($conn, "SELECT * FROM `threads` WHERE `id`='$id'");
    if (mysqli_num_rows($query) > 0) {
    			$info = mysqli_fetch_array($query);
    			$title = $info['title'];
    			$body = $info['body'];
    			$tags = $info['tags'];
    }
    
    
    
    ?>


<?php
} # END OF GET


    	if (isSet($_POST['update_thread'])) {
	    # Simple verification check, if i had more time i would add more thorough checks but I think i spent too much time on the design of the site 
    	if (isSet($_POST['title']) && isSet($_POST['description']) && isSet($_SESSION['username']) && $_SESSION['username'] != '' && isSet($_POST['tags']) ) {
    		# strip any html tags from user input
    		$title = mysqli_real_escape_string($conn,strip_tags($_POST['title']));
    		$description = mysqli_real_escape_string($conn, strip_tags($_POST['description']));
    		$tags = mysqli_real_escape_string($conn, strip_tags($_POST['tags']));
    		$tags = strtolower($tags);
    		#$id = $_POST['id'];
    		# More checks to ensure content meets requirements
    		if (strlen($title) <= 3) {
                $errors .= 'Title must be longer than 4 characters<br>';
            }
            if (strlen($description) <= 4) {
                $errors .= 'Body of post must be longer than 4 characters<br>';
            }
            if (strlen($tags) <= 3) {
                $errors .= 'Please include at least one tag<br>';
            }
            # If no errors, update data
            if (!$errors) {
                $q = mysqli_query($conn, "UPDATE  threads SET title = '$title', body =  '$description', tags = '$tags' WHERE  id ='$id'") or die(mysql_error());
                if ($q) {
                    $alert = 'Thread Updated!';
                    $_SESSION['title'] = '';
                    $_SESSION['body']  = '';
                    $_SESSION['tags']  = '';
                } else
                    $alert = 'Failed to update thread.';

            } 
    		

} # end of verification
} # end of $_POST




} # END OF ADMIN IF

else {
    header("Location: ../index.php");
}
?>

        <style>body { background: -webkit-linear-gradient(left, #bb91c6, #aa5bbd)}</style>
                <div class="container create_thread" style="margin-bottom: 0; margin-top: 50px">
                <form action="edit.php?threadid=<?php echo $id;?>" method="POST">
                <h3>EDIT THREAD</h3>
               <div class="row">
                    <div class="col-md-12">
                        <label>Thread ID</label>
                        <div class="form-group">
                            <input type="text" name="id" class="form-control" placeholder="Title" value="<?php echo $id; ?>" readonly/>
                        </div>
                        <label>Thread Name</label>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $title; ?>" />
                        </div>
                        <label>Thread Body</label>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="Body"><?php echo $body; ?></textarea>

                        </div>
                        <label>Thread Tags</label>
                        <div class="form-group">
                            <input type="text" name="tags" class="form-control" placeholder="Tags: Seperated by a comma" value="<?php echo $tags; ?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update_thread" class="btnThread" value="Update Thread" />
                        </div>
                    </div>

                </div>
            </form>
            <div class="container">
        <p class="text-center alert2"><?php
echo $errors;
?></p>
        <p class="text-center alert2"><?php
echo $alert;
?> </p>
        </div>
            </div>

