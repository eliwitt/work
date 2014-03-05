<html>
<head></head>
<body>
<?php 
//
//  theBear uses the classes PhpClass and PolarBear to demo
//  both classes and inhertance.
//
include('./PhpClass.php');
include('./PolarBear.php');
$bob = new Bear; 
$bob->name = "Bobby Bear"; 
$bob->eat(100); 
echo '<br />';
$bob->eat(200); 
echo '<br />';
echo $bob->getLastMeal(); 
// the next line will generate a fatal error 
//try {
//	$bob->_lastUnitsConsumed = 1000; 
//} catch (Exception $e) {
//	echo $e->getMessage();
//}

echo '<hr />';
// create instance of PolarBear() 
$tom = new PolarBear; 
$tom->name = "Mike Bear"; 

// $tom can use all the methods of Bear() and PolarBear() 
$tom->run(); 
echo '<br />';
$tom->kill(); 
echo '<br />';
$tom->swim(); 

?>
</body>
</html>