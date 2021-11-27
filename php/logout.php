<?php
  // in order to login out we have to destory the current session
  session_start();
	// unset the session variables and flags to reset submission.php to a fresh page
	unset($_SESSION['userfullname']);
	unset($_SESSION['valid']);
	
	// or session_unset()
	// destroy the session to release the variables
	session_destroy();
	// redirect to the submission.php page
  if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  }	
?>
