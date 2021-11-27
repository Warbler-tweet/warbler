<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
  session_start();
	// reviews.php recieve the form submission from submission.php for all user parameters for making a review in teh database table
	// if html post is received then process the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// check the parameters are set
		if( (isset($_POST['save_token'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['rating']))) {
			// check the parameters are non empty
			if( (!empty($_POST['save_token'])) && (!empty($_POST['name'])) && (!empty($_POST['description'])) && (!empty($_POST['rating']))) {
				// check the security token is unaltered
				if($_POST['save_token'] == 'abcdefg') {
					// store the form parameters for creating a record in the reviews table of the database
					$name = $_POST['name'];
					$description = $_POST['description'];
					$rating = $_POST['rating'];
					$user = $_SESSION['userfullname'];
					// create an sql connection
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					// check the connection established
					if ($conne->connect_error) {
						die("Connection failed while inserting data: ".$conne->connect_error);
						
					} else {
						// use prepared statements for SQL security
						$stmt = $conne->prepare("INSERT INTO reviews (name, username, description, rating) 
						VALUES (?, ?, ?, ?)");
					  $stmt->bind_param("sssi", $name, $user, $description, $rating);
						
						// if the sql query is successful a new business review is entered, but the business table needs to be updated
						// for each business has an average rating in that table
						if ($stmt->execute() === TRUE) {
							echo "New review created successfully.";
							// create an SQL query to find the average rating values for each business
						  $sql2 = "SELECT name, AVG(rating) FROM reviews GROUP BY name";
						  $result = $conne->query($sql2);
							// if the results are nonempty
							if  ($result->num_rows > 0) {
								// loop through the businesses until a mathcing name is found
								while ($row = $result->fetch_assoc()) {
								  // once the match is found, store the AVG is a variable
									if ($name == $row['name']) {
										$avg = $row['AVG(rating)'];
										// create a third sql query to update the matching business with the new average rating
										$sql3 = "UPDATE businesses SET rating = '$avg' WHERE name='$name'";
								    // if the query is successful print to screen
										if ($conne->query($sql3) === TRUE) {
									    echo "New average rating stored successfully.";
								    } else {
									    echo "Error: " . $sql3 . "<br>" . $conne->error;
								    }
									}
								}
							}
						} else {
							echo "Error: " . $sql . "<br>" . $conne->error;
					  }
						// fincally close the connection
						$conne->close();
					}
				} else {
					// if the save token is changed
						echo "invalid_access";
				}
			} else {
				// if the form data is empty
					echo "empty_data";
			}
		}	else {
			// if the form data is not set
        echo "invalid_data";
		}
						
    
    }	
?>
<br> <br>
<!-- create a button to return to previous page-->
<a href="../submit/submission.php"> Go back. </a>
</html>