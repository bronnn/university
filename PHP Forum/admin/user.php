<?php 
include '../inc/templates/header.php'; 


if ($level == 1){
    # If the users access level is 1 (admin) they are able to access the list of users, and also edit and delete users
    # If the user isn't an admin they are redirected to the homepage
    


echo '<div class="container threadbody">
    <h2> USER MANAGEMENT</h2>';
        $q = mysqli_query($conn, "SELECT * FROM `users`");
    

    if (mysqli_num_rows($q) > 0) {
    	$list = '<table class="table">
    	<tbody>
            <tr>
              <th scope="col">Username</th>
              <th scope="col">Delete The User</th>
              <th scope="col">Make an Admin</th>
            </tr>';
    }
    

    while ($row = mysqli_fetch_array($q)) {
    	$list .= '
    	<tr><td><a href="../user.php?username='.$row["username"].'">'.ucfirst($row["username"]).'</a></td>
    	<td><a href="delete.php?id=' .$row["user_id"] .'">Delete</a></td>
    	<td><a href="admin.php?id=' .$row["user_id"] .'">Make An Admin</a></td></tr>';

    }
    $list .= '</tbody></table></div>';
    if (isSet($list)){ echo $list; }
    }
    
    
    
    else {
        header("Location:../index.php");
  		exit();
    }
    ?>
    

   
    


