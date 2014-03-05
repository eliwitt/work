<html> 
<head></head>
<body> 

<?php 
// retrieve form data 
$input = $_POST['msg']; 
// use it 
echo "You said: <i>$input</i>"; 
?> 
<hr />
<?php 

/* define some variables */
$auth = 1; 
$status = 1; 
$role = 4; 

/* logical AND returns true if all conditions are true */ 
// returns true 
$result = (($auth == 1) && ($status != 0)); 
print "result is $result<br />"; 

/* logical OR returns true if any condition is true */ 
// returns true 
$result = (($status == 1) || ($role <= 2)); 
print "result is $result<br />"; 

/* logical NOT returns true if the condition is false and vice-versa */ 
// returns false 
$result = !($status == 1); 
print "result is $result<br />"; 

/* logical XOR returns true if either of two conditions are true, or returns false if both conditions are true */ 
// returns false 
$result = (($status == 1) xor ($auth == 1)); 
print "result is $result<br />"; 

?> 
</body> 
</html> 