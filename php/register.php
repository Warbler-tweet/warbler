<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if( (isset($_POST['save_token'])) && (isset($_POST['username'])) && (isset($_POST['email'])) && (isset($_POST['password'])) && (isset($_POST['checkbox']))) {
			if( (!empty($_POST['save_token'])) && (!empty($_POST['username'])) && (!empty($_POST['email'])) && (!empty($_POST['password'])) && (!empty($_POST['checkbox']))) {
				if($_POST['save_token'] == 'abcdefg') {
					$name = $_POST['username'];
					$email = $_POST['email'];
					$pass = $_POST['password'];
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					
					if ($conne->connect_error) {
						die("Connection failed while inserting data: ".$conne->connect_error);
						
					} else {
						$stmt = $conne->prepare("INSERT INTO userbase (username, email, password) VALUES (?, ?, ?)");
					  $stmt->bind_param("sss", $name, $email, $pass);
						//$stmt->execute();
											
						
						//$sql = "INSERT INTO userbase (username, email, password) VALUES ('$name', '$email', '$pass')";
						
						//if ($conne->query($sql) === TRUE) {
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
<a href="../register/registration.php"> Go back. </a>
</html>