<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Checkout</title>
	</head>
	<body>
    	<?php
		
			for ($i=0; $i < count($_POST['productId']); $i++) {
				print 'ProductID: '.$_POST['productId'][$i].', Qty:'.$_POST['productQty'][$i]."<br>";
			}

		?>		
	</body>
</html>