<html> 
<head></head>
<body> 

<?php 
// read recipe file into array 
// the file function will read the entire file and then close it
//
$data = file("C:/Inetpub/wwwroot/work/phpexamples/omelette.txt") or die('Could not read file!'); 
/* first line contains title: read it into variable */ 
$title = $data[0]; 
// remove first line from array 
array_shift($data); 
?> 

<h2><?php echo $title; ?></h2> 

<?php 
/* iterate over content and print it */ 
foreach ($data as $line) { 
    echo nl2br($line); 
} 
?> 

</body> 
</html>