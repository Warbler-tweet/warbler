<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
	// business.php recieves the form submission from submission.php for all user parameters for entering a business into the database table
	// if html post is received then process the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// check the form parameters are set
		if( (isset($_POST['save_token'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['latitude'])) && (isset($_POST['longitude']))) {
			// check the form parameters are non empty
			if( (!empty($_POST['save_token'])) && (!empty($_POST['name'])) && (!empty($_POST['description'])) && (!empty($_POST['latitude'])) && (!empty($_POST['longitude']))) {
				// check the security token is unaltered
				if($_POST['save_token'] == 'abcdefg') {
					
					// store the form parameters for creating a row in the database table
					$name = $_POST['name'];
					$description = $_POST['description'];
					$latitude = $_POST['latitude'];
					$longitude = $_POST['longitude'];
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
						// use prepare statements for SQL security
						$stmt = $conne->prepare("INSERT INTO businesses (name, latitude, longitude, description) 
						VALUES (?, ?, ?, ?)");
					  $stmt->bind_param("sdds", $name, $latitude, $longitude, $description);
						// if the query is successful print to screen
						if ($stmt->execute() === TRUE) {
							echo "New record created successfully.";
						} else {
							echo "Error: " . $sql . "<br>" . $conne->error;
					  }
						// close connection
						$conne->close();
					}
				} else {
					// if save token is changed
						echo "invalid_access";
				}
			} else {
				// if form data is empty
					echo "empty_data";
			}
		}	else {
			// if form data is not set
        echo "invalid_data";
		}
						
    
    }	
?>
<br> <br>
<!-- create a button to return to previous page-->
<a href="../submit/submission.php"> Go back. </a>
</html>