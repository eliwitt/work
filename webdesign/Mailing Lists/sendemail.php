<?php
	
	// This script sends a newsletter to the database of subscribers
	
	// Make sure you protect it with a username and passeord at minimum!
	
	include_once "connect.php";
	$sql = mysql_query("SELECT * FROM subscribers");

	// We'll loop through each record in the database, sending an email to each address
	while($row = mysql_fetch_array($sql)){
		$email = $row["email"];
		$name = $row["name"];

			
		/*
		
		ADD YOUR OWN HTML INSIDE THE QUOTES OF THE $body VARIABLE
		
		Don't forget to personalise your email by using the $email and $name variables - e.g.
		
		DON'T FORGET TO ESCAPE YOUR QUOTES!
		
		$body = '<html>
					<head>
						<title>My email</title>
					</head>
					<body>
						<h1>Great offers on widgets</h1>
						<p>Dear '.$name.',</p>
						<p>Welcome to our newsletter. This month we\'ve got some great offers on widgets for subscribers...
						
						etc etc
						<p>Want to unscubscribe from our newsletter? <a href="http://yourdomain.com/unsubscribe.php?email='.$email.'">Click here to instantly remove yourself</a></p>
					</body>
				</html>'
		
		
		
		*/
		
		$body = 'YOUR HTML CONTENT HERE';	
		
		// Add your own subject below
	    $subject = "YOUR EMAIL SUBJECT";
		
		// Add your "sending" email below
	    $headers  = "From:you@yourdomain.com\r\n";
    	$headers .= "Content-type: text/html\r\n";
		
		// We'll set the email "to" address to the database record
    	$to = "$email";

		// And send the email!
    	$mailresult = mail($to, $subject, $body, $headers);
	
	}
?>