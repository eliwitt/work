<?php
	
	// This script allows a user to unsubscribe. 
	
	// First, get the email address from the querystring

	if (isset($_GET['email'])) {
	
		include_once "connect.php";
		
		// Remember to clean the input to protect against SQL Injection
		$email = $_GET['email'];
	
		// Run the delete query
		$deleteresult = mysql_query("DELETE FROM subscribers WHERE email='$email'");
	
		// Report back to the user
		if ($deleteresult) {
			echo("Thanks. You were unsubscribed successfully.");
		} else {
			echo "We had a problem removing your email address from the newsletter. Please contact us directly and we'll remove you manually.";
		}
	}
?>