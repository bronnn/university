<?php
include 'config.php';
include 'inc/templates/header.php';
$alert = '';
# $errors = "";
if ($_SESSION['username']) {
    if (isSet($_POST['create_thread'])) {
        # Simple verification check, if i had more time i would add more thorough checks but I think i spent too much time on the design of the site 
        
        if (isSet($_POST['title']) && isSet($_POST['description'])  && isSet($_SESSION['username']) && isSet($_POST['tags'])) {
            # strip any html tags from user input and prepare SQL Statement to reduce chance of SQL injection
            
            $title             = mysqli_escape_string($conn, strip_tags($_POST['title']));
            $description       = mysqli_escape_string($conn, strip_tags($_POST['description']));
            $tags              = mysqli_escape_string($conn, strip_tags($_POST['tags']));
            $tags              = strtolower($tags);
            $user              = $_SESSION['username'];
            
            # Declaring sesion variables so if user types someting wrong they dont lose everything
            $_SESSION['title'] = $title;
            $_SESSION['body']  = $description;
            $_SESSION['tags']  = $tags;
     
            # Error checking to make sure the user has filled in the fields
            if (strlen($title) <= 3) {
                $errors .= 'Title must be longer than 4 characters<br>';
            }
            if (strlen($description) <= 4) {
                $errors .= 'Body of post must be longer than 4 characters<br>';
            }
            if (strlen($tags) <= 3) {
                $errors .= 'Please include at least one tag<br>';
            }
            if (!$errors) {
                $q = mysqli_query($conn, "INSERT INTO `threads` VALUES ('', '$title', '$description', '$user', '0', '0', '$tags')") or die(mysql_error());
                if ($q) {
                    $alert = 'Thread created.';
                    $_SESSION['title'] = '';
                    $_SESSION['body']  = '';
                    $_SESSION['tags']  = '';
                } else
                    $alert = 'Failed to create thread.';

            } 
            
        }
    }
} else {
    header("Location: login.php");
    
}

?>


<!-- CREATE THREAD FORM -->

<style>body { background: -webkit-linear-gradient(left, #bb91c6, #aa5bbd)}</style>
<div class="container create_thread">
            <form action="create_thread.php" method="POST">
                <h3>CREATE THREAD <?php
strlen($errors);
?></h3>
               <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control" placeholder="Title" value="<?php
echo $_SESSION['title'];
?>" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="description" placeholder="Body"><?php
echo $_SESSION['body'];
?></textarea>

                        </div>
                        <div class="form-group">
                            <input type="text" name="tags" class="form-control" placeholder="Tags: Seperated by a comma" value="<?php
echo $_SESSION['tags'];
?>" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="create_thread" class="btnThread" value="Create Thread" />
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <div class="container">
        <p class="text-center alert"><?php
echo $errors;
?></p>
        <h2 class="text-center alert"><?php
echo $alert;
?> </h2>
        </div>
        </body>
    </html>