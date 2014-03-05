<html> 
<head> 
<basefont face="Arial"> 
</head> 
<body> 

<?php 
$Reno = 360000;
$Pasadena = 138000;
$cityname = "Reno";
echo "The size of $cityname is ${$cityname}<br /> ";
$cityname = "Pasadena";
echo "The size of $cityname is ${$cityname} ";
echo "<hr />";
$cities['AZ']['Maricopa'] = 'Phoenix';
$cities['OR']['Multnomah'] = 'Portland';
$cities['OR']['Tillamook'] = 'Tillamook';
$cities['AZ']['Cochise'] = 'Tomstone';
$cities['AZ']['Yuma'] = 'Yuma';
$cities['OR']['Wallowa'] = 'Joseph';
foreach($cities as $state => $counties)
{
	//print_r($state);
	foreach($counties as $county => $city)
	{
	//print_r($state);
		echo "$city, $county county in $state<br />";
	}
}
?> 
</body>
</html>