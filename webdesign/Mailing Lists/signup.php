<?php
	$name = "";
	$email = "";
	$completed = false;
	if ($_POST['name'] != "" && $_POST['email'] != "") {
		include_once "connect.php";
		echo("name ".$_POST['name']." email ".$_POST['email']);
		
	}

// Show the form if the $completed flag is false

if ($completed==false) {

?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<fieldset> 
			<legend>Subscribe to Our Newsletter &nbsp;</legend> 
			<?php if ($feedback!='') echo('<p>'.$feedback.'</p>'); ?>
			<label>Name: <input name="name" type="text" value="<?php echo $name; ?>" /></label>
			<label>Email: <input name="email" type="text" value="<?php echo $email; ?>" /></label>
			<label><input type="submit" value="Sign Up!" /></label>
		</fieldset> 
	</form>
<?php 

} else {
	// Otherwise, show a thank you message

	echo('Thanks - you have been subscribed to our newsletter successfully. You can unsubscribe at any time by clicking on the link at the bottom of each email we send.');

}




	// This function attempts to loosely clean the input to prevent SQL injection attacks
	
	function cleaninput($value, $DB) {
		if (get_magic_quotes_gpc()) {
			$value = stripslashes( $value );
		}
		
		return mysql_real_escape_string( $value, $DB );
	}
?>