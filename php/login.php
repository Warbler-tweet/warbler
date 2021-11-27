<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
  session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['login_token'])) {
      if (!empty($_POST['login_token'])) {
        if( (isset($_POST['username'])) && (isset($_POST['password'])) ) {
			    if( (!empty($_POST['username'])) && (!empty($_POST['password']))) {
				  
					$name = $_POST['username'];
					$pass = $_POST['password'];
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					
					if ($conne->connect_error) {
						die("Connection failed while retrieving data: ".$conne->connect_error);
						
					} else {
						$sql = "SELECT username, password FROM userbase";
						$result = $conne->query($sql);
            if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								if (($name == $row['username']) && ($pass == $row['password'])) {
									$_SESSION['userfullname'] = $name;
						      $_SESSION['valid'] = true;
						
						      $lblrememberme = '0';
						      if (isset($_POST['checkbox'])){
							      if (!empty($_POST['checkbox'])) {
								      setcookie('rememberme', '1', time() + (86400 * 30), "/");
								      setcookie('uname', $_POST['username'], time() + (86400 * 30), "/");
							      } else {
								      setcookie('rememberme', null, -1, '/');
								      setcookie('uname', null, -1, '/');
							      }
						      } else {
							      setcookie('rememberme', null, -1, '/');
							      setcookie('uname', null, -1, '/');
						      }
								  $conne->close();
									// valid
					        if (isset($_SERVER["HTTP_REFERER"])) {
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
						      }
								}
							}
						}
						$conne->close();
					}
					$_SESSION['status_message'] = 'invalid';
					if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
					}
				} else {
					echo 'invalid_request';
				}
			} else {
				echo 'invalid_request';
			}
		} else {
			echo 'invalid_request';
		}
	} else {
		echo 'invalid_request';
	}
	
	
}
			
				  //if($_POST['save_token'] == 'abcdefg') {
					//$name = $_POST['username'];
					//$pass = $_POST['password'];
					
					//$servername = "localhost";
					//$username = "root";
					//$password = "";
					//$dbname = "thewarbler";
					
					//$conne = new mysqli($servername, $username, $password, $dbname);
					
					//if ($conne->connect_error) {
					//	die("Connection failed while inserting data: ".$conne->connect_error);
						
					//} else {
						// "SELECT (username, password) FROM userbase
				//		$sql = "INSERT INTO userbase (username, email, password) VALUES ('$name', '$email', '$pass')";
						
					//	if ($conne->query($sql) === TRUE) {
					//		echo "New record created successfully.";
					///	} else {
						//	echo "Error: " . $sql . "<br>" . $conne->error;
					  //}
						//$conne->close();
					//}
				//} else {
				//		echo "invalid_access";
			//	}
			//} else {
				//	echo "empty_data";
		//	}
		//}	else {
    //    echo "invalid_data";
		//}
						
    //if (isset($_SERVER["HTTP_REFERER"])) {
      //  header("Location: " . $_SERVER["HTTP_REFERER"]);
    //}	
?>
<br> <br>
<a href="../submit/submission.php"> Go back. </a>
</html>