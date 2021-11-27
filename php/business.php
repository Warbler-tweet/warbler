<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if( (isset($_POST['save_token'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['latitude'])) && (isset($_POST['longitude']))) {
			if( (!empty($_POST['save_token'])) && (!empty($_POST['name'])) && (!empty($_POST['description'])) && (!empty($_POST['latitude'])) && (!empty($_POST['longitude']))) {
				if($_POST['save_token'] == 'abcdefg') {
					$name = $_POST['name'];
					$description = $_POST['description'];
					$latitude = $_POST['latitude'];
					$longitude = $_POST['longitude'];
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					
					if ($conne->connect_error) {
						die("Connection failed while inserting data: ".$conne->connect_error);
						
					} else {
						$stmt = $conne->prepare("INSERT INTO businesses (name, latitude, longitude, description) 
						VALUES (?, ?, ?, ?)");
					  $stmt->bind_param("sdds", $name, $latitude, $longitude, $description);
						//$stmt->execute();
						
						
						//$sql = "INSERT INTO businesses (name, latitude, longitude, description) 
						//VALUES ('$name', '$latitude', '$longitude', '$description')";
						
						if ($stmt->execute() === TRUE) {
							echo "New record created successfully.";
						} else {
							echo "Error: " . $sql . "<br>" . $conne->error;
					  }
						$conne->close();
					}
				} else {
						echo "invalid_access";
				}
			} else {
					echo "empty_data";
			}
		}	else {
        echo "invalid_data";
		}
						
    //if (isset($_SERVER["HTTP_REFERER"])) {
      //  header("Location: " . $_SERVER["HTTP_REFERER"]);
    }	
?>
<br> <br>
<a href="../submit/submission.php"> Go back. </a>
</html>