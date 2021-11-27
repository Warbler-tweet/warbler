<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
<?php
  // sessions are required to login to the web page
	// only when logged in will the full page be revealed
	// using sessions will grant access to global variables shared between this page and the submission.php
  session_start();
	// if html post is recieved then process the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// check the login_token is set and nonempty for security
	if (isset($_POST['login_token'])) {
    if (!empty($_POST['login_token'])) {
			if($_POST['login_token'] == 'abcdefg') {
				// check the form parameters are set
        if( (isset($_POST['username'])) && (isset($_POST['password'])) ) {
					// check the form parameters are non empty
			    if( (!empty($_POST['username'])) && (!empty($_POST['password']))) {
				  // store the form parameters in variables for searching database
					$name = $_POST['username'];
					$pass = $_POST['password'];
					// create an sql connection
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "thewarbler";
					
					$conne = new mysqli($servername, $username, $password, $dbname);
					// check the connection established
					if ($conne->connect_error) {
						die("Connection failed while retrieving data: ".$conne->connect_error);
						
					} else {
						// use sql query to retrieve the set of users
						$sql = "SELECT username, password FROM userbase";
						$result = $conne->query($sql);
						// if the query results are non-empty
            if ($result->num_rows > 0) {
							// loop through the users 
							while ($row = $result->fetch_assoc()) {
								// check that the credentials are in the database table
								if (($name == $row['username']) && ($pass == $row['password'])) {
									// if so then set the login session parameters stored by the session
									$_SESSION['userfullname'] = $name;
						      $_SESSION['valid'] = true;
						      // clear the remember label
						      $lblrememberme = '0';
									// if the user has checked the box, and the box is non empty
									// then set the cookies for username and rememberme checkbox
						      if (isset($_POST['checkbox'])){
							      if (!empty($_POST['checkbox'])) {
								      setcookie('rememberme', '1', time() + (86400 * 30), "/");
								      setcookie('uname', $_POST['username'], time() + (86400 * 30), "/");
							      } else {
											// if the box is empty destroy the cookie
								      setcookie('rememberme', null, -1, '/');
								      setcookie('uname', null, -1, '/');
							      }
						      } else {
										// if the box is not set then destroy the cookie
							      setcookie('rememberme', null, -1, '/');
							      setcookie('uname', null, -1, '/');
						      }
									// the login is valid and can close the connection and return to the login page
								  $conne->close();
									// valid
					        if (isset($_SERVER["HTTP_REFERER"])) {
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
						      }
								}
							}
						}
						// close the connection
						$conne->close();
					}
					// set the session cookie to notify the user that the credentials are invalid
					$_SESSION['status_message'] = 'invalid';
					// return to previous page
					if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
					}
				} else {
					// if the form data is empty
					echo 'invalid_request';
				}
			} else {
				// if the form data is not set
				echo 'invalid_request';
			}
			} else {
				// if the login token is is changed then invalid access
				echo 'invalid_access';
			}
		} else {
			// if the login token is  empty
			echo 'invalid_request';
		}
	} else {
		// if the login token is not set
		echo 'invalid_request';
	}
	
	
}
			
?>
<br> <br>
<a href="../submit/submission.php"> Go back. </a>
</html>
