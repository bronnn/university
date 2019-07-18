<?php 
include '../inc/templates/header.php'; 


if ($level == 1){
    # IF the users access level is 1 (admin) they are able to make other users admins
    # If the user isn't an admin they are redirected to the homepage
    if (isSet($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id'];
        $q = mysqli_query($conn, "SELECT * FROM `users`");
        
        if (mysqli_num_rows($q) > 0) {
             while ($row = mysqli_fetch_array($q)) {
                 $user_level = $row['user_level'];
             }
            }
    
        if ($user_level != 1){
            $q2 = mysqli_query($conn, "UPDATE  `forum`.`users` SET  `user_level` =  '1' WHERE  `users`.`user_id` ='$id'");
            header("Location: user.php");
  		    exit();
        }
        else {
            # User is already an admin
            header("Location: user.php");
  		    exit();
            
        }

    



    }

}
    
    
    else {
        header("Location:../index.php");
  		exit();
    }
    ?>
    
