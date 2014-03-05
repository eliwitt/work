<?php 

// initialize a session 
session_start(); 

// increment a session counter 
$_SESSION['counter']++; 

// print value 
echo "You have viewed this page " . $_SESSION['counter'] . " times"; 

?> 