<?php 
include 'inc/templates/header.php'; 
include 'config.php';

# This is a simple search function
# All the posts in the database contain tags which are seperated by commas
# This query checks tagged posts against the users query
#  $returns - preparing the table to add search results to
	$returns = '<div class="threadbody container"><h2>Search Results</h2><table><tbody>';
	# Simple validation to check if the serach form was posted and whether the search box contained data
	if (isSet($_POST['search_btn']) && isSet($_POST['searchtxt']) && $_POST['searchtxt'] != '') {
		$s = $_POST['searchtxt'];
		$s = strtolower($s);
		# The explode fuction here splits the search string into an array
		$ss = explode(' ', $s);
		# Gets every row in the thread table ready to search for tags
		$q = mysqli_query($conn, "SELECT * FROM `threads`");
		
		# If threads are found - basically if there are records in the threads table
		if (mysqli_num_rows($q) > 0) {
			while ($row = mysqli_fetch_array($q)) {
				$hastags= false;
				# Initially set the hastags value to false before checking if the data contains the tags
				if ($row['tags'] != '') {
					# This if statement only checks posts that have data in the tags column
					# All tags are converted to lower case
					$tags = strtolower($row['tags']);
					for ($i=0;$i<count($ss);$i++) {
						 # Loops through all the sub strings looking for entries that contain the tag
						 # It then sets the tag value to true
						if (strpos($tags, $ss[$i]) !== false) {
							$hastags = true;
						}
					}
				}
				if ($hastags) {
					# This appends all the posts containg the tag to the $returns string
					$returns .= '<tr><td><a href="thread.php?tid='.$row["id"].'">'.ucfirst($row["title"]).'</a></td></tr>';
				}
			}
		}
	}
echo '</div>';
?>

	<div class="container threadbody">
		<?php if(strlen($returns) <= 71){
			
			# This is probably a really bad way to do this but it works
			# Basically if no results are found then the length of the table body string is always less than 71
			# if data is found new table rows are added so the length of the string is increased
			
			echo '<p> No Results Found</p>';
		}
		else {
			echo $returns; 
			}
		?>
		
		
	</div>
