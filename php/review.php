<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
  session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if( (isset($_POST['save_token'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['rating']))) {
			if( (!empty($_POST['save_token'])) && (!empty($_POST['name'])) && (!empty($_POST['description'])) && (!empty($_POST['rating']))) {
				if($_POST['save_token'] == 'abcdefg') {
					$name = $_POST['name'];
					$description = $_POST['description'];
					$rating = $_POST['rating'];
					$user = $_SESSION['userfullname'];
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					
					if ($conne->connect_error) {
						die("Connection failed while inserting data: ".$conne->connect_error);
						
					} else {
						$stmt = $conne->prepare("INSERT INTO reviews (name, username, description, rating) 
						VALUES (?, ?, ?, ?)");
					  $stmt->bind_param("sssi", $name, $user, $description, $rating);
						//$stmt->execute();
						
						//$sql = "INSERT INTO reviews (name, username, description, rating) 
						//VALUES ('$name', '$user', '$description', '$rating')";
						
						if ($stmt->execute() === TRUE) {
							echo "New review created successfully.";
						  $sql2 = "SELECT name, AVG(rating) FROM reviews GROUP BY name";
						  $result = $conne->query($sql2);
							if  ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									
									
									if ($name == $row['name']) {
										$avg = $row['AVG(rating)'];
										$sql3 = "UPDATE businesses SET rating = '$avg' WHERE name='$name'";
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