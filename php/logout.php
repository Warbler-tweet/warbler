<?php
  session_start();
	
	unset($_SESSION['userfullname']);
	unset($_SESSION['valid']);
	
	// or session_unset()
	
	session_destroy();
						
  if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
  }	
?>
