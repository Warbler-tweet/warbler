<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
  // register.php recieves the form submission from registration.php for all user parameters for making an account in the database
	// if html post is received then process the form
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// check the form parameters are set
		if( (isset($_POST['save_token'])) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['password'])) && (isset($_POST['checkbox']))) {
			// check the form parameters are non empty
			if( (!empty($_POST['save_token'])) && (!empty($_POST['username'])) && (!empty($_POST['email'])) && (!empty($_POST['password'])) && (!empty($_POST['checkbox']))) {
				// check the security token is unaltered
				if($_POST['save_token'] == 'abcdefg') {
					// store the form paramters in varaibles for creating a row in the database table
					$name = $_POST['username'];
					$email = $_POST['email'];
					$pass = $_POST['password'];
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
						$stmt = $conne->prepare("INSERT INTO userbase (username, email, password) VALUES (?, ?, ?)");
					  $stmt->bind_param("sss", $name, $email, $pass);
						// if the query is successful print to screen

						if ($stmt->execute() === TRUE) {	
							echo "New record created successfully.";
						} else {
							echo "Error: " . $sql . "<br>" . $conne->error;
					  }
						// close the connection
						$conne->close();
					}
				} else {
					// if the save token is changed then return invalid access
						echo "invalid_access";
				}
			} else {
				// if the form data is empty then return empty data
					echo "empty_data";
			}
		}	else {
			// if the form data is not set then return invalid data
        echo "invalid_data";
		}
    }	
?>
<br> <br>
<!-- create a button to return to previous page-->
<a href="../register/registration.php"> Go back. </a>
</html>