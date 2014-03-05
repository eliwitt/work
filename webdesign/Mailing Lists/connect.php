<?php

	// Be sure to update the values below with your own settings
	// These will be provided by your host myPHPds  192.168.1.9 127.0.0.1 1433

	$host = 'ADAPTIVEDEV3'; 
	$username = "sa";  
	$pass = "adaptivesql";  
	$db = "myTDDdb"; 
	//odbc_connect($host, $username,$pass) or die ("could not connect to mysql");
	$myconnection = mysql_connect($host, $username,$pass) or die ("could not connect to mysql");
	mysql_select_db($db) or die ("Couldn't connect to the database");    

?>