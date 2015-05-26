<!doctype html>
<html>
	<head>
    <title>Fedex Rate service</title>
    <!-- CSS -->
	<link href="assets/css/styles.css" rel="stylesheet" type="text/css">  
	</head>
<body>
	<section class="container">
		<header>
		<h2>Vincent Fedex Rate Lookup</h2>
		</header>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			Zip code: <input type="text" pattern="[0-9]{5}" name="zipno" size="5" autofocus required title="Zip code is a required 5 digit field" />  Weight:<input type="text" name="Weight" size="5" required title="Weight is required" /> LB <br />
    <fieldset>            
    <legend>Dimensions (in Inches)</legend>
    <div class="field">
    <label for="Length">Length:</label>
    <input type="text" name="Length" size="5" required title="Length is required" />
    </div>
    <div class="field">
    <label for="Width">Width:</label>
    <input type="text" name="Width" size="5" required title="Width is required" />
    </div>
    <div class="field">
    <label for="Height">Height:</label>
    <input type="text" name="Height" size="5" required title="Height is required" />
    </div>
    <div class="field">
    <label for="Boxes">Boxes:</label>
    <input type="text" name="boxes" size="5" value="1" required title="Boxes is required" />
    </div>
	</fieldset>
            Get the <input type="submit" name="submit" value="Rates">
		</form>
<?php
//  has the submit button been pressed
//
if (isset($_POST['submit'])) {
	/* check each field except middle name for blank fields */
	foreach($_POST as $field => $value)
	{
		if($value == "")
		{
		  /* The following is for optional fields
		  if($field != "optional field name")	
		  {
		     $blank_array[] = $field;
		  } // endif field is not middle name
		  */
		  $blank_array[] = $field;
		} // endif field is blank
		else
		{
		  $good_data[$field] = strip_tags(trim($value));
		}
	}  // end of foreach loop for $_POST
	/* if any fields were blank, create error message and 
	redisplay form */
	if(@sizeof($blank_array) > 0)
	{
		$message = "<p style='color: red; margin-bottom: 0; 
			font-weight: bold'>
			You didn't fill in one or more required fields. 
			You must enter: 
			<ul style='color: red; margin-top: 0; 
			list-style: none' >";
		/* display list of missing information */
		foreach($blank_array as $value)
		{
			$message .= "<li>$value</li>";
		}
		$message .= "</ul>"; 
		/* redisplay form */
		extract($good_data);
		print $message;
	} // endif blanks
	else
	{
		callFed($good_data);
	}
}
//
// this function uses the form input fields to call the 
// fedex rate service.  And then formats the output.
//
function callFed($good_data)
{
	$key = 'HeKXEq5FlFY08sYf';
	$password = 'K69h7qMT9YiWMAB3RfAGHjptV';
	$account_number = '100816008';
	$meter_number = '103526242';
	$xml = '<?xml version="1.0" encoding="UTF-8"?>
    <SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="http://fedex.com/ws/rate/v13"><SOAP-ENV:Body><ns1:RateRequest>
    <ns1:WebAuthenticationDetail>
    <ns1:UserCredential>
    <ns1:Key>'.$key.'</ns1:Key>
    <ns1:Password>'.$password.'</ns1:Password>
    </ns1:UserCredential></ns1:WebAuthenticationDetail>
    <ns1:ClientDetail>
    <ns1:AccountNumber>'.$account_number.'</ns1:AccountNumber>
    <ns1:MeterNumber>'.$meter_number.'</ns1:MeterNumber>
    </ns1:ClientDetail>
    <ns1:TransactionDetail><ns1:CustomerTransactionId> *** Rate Request v13 using PHP ***</ns1:CustomerTransactionId></ns1:TransactionDetail><ns1:Version><ns1:ServiceId>crs</ns1:ServiceId><ns1:Major>13</ns1:Major><ns1:Intermediate>0</ns1:Intermediate><ns1:Minor>0</ns1:Minor></ns1:Version><ns1:ReturnTransitAndCommit>true</ns1:ReturnTransitAndCommit><ns1:RequestedShipment>
    <ns1:DropoffType>REGULAR_PICKUP</ns1:DropoffType>
    <ns1:PackagingType>YOUR_PACKAGING</ns1:PackagingType>
    <ns1:TotalInsuredValue><ns1:Currency>USD</ns1:Currency></ns1:TotalInsuredValue>
    <ns1:Shipper><ns1:Contact><ns1:PersonName>TJ REID</ns1:PersonName><ns1:CompanyName>Vincent Printing</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines>1512 Sholar Avenue</ns1:StreetLines><ns1:City>Chattanooga</ns1:City><ns1:StateOrProvinceCode>TN</ns1:StateOrProvinceCode>
    <ns1:PostalCode>37406</ns1:PostalCode><ns1:CountryCode>US</ns1:CountryCode></ns1:Address></ns1:Shipper>
    <ns1:Recipient><ns1:Contact><ns1:PersonName>Recipient Name</ns1:PersonName><ns1:CompanyName>Company Name</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines></ns1:StreetLines><ns1:City></ns1:City><ns1:StateOrProvinceCode></ns1:StateOrProvinceCode>
    <ns1:PostalCode>'.$good_data['zipno'].'</ns1:PostalCode>
    <ns1:CountryCode>US</ns1:CountryCode><ns1:Residential>false</ns1:Residential></ns1:Address></ns1:Recipient><ns1:ShippingChargesPayment><ns1:PaymentType>SENDER</ns1:PaymentType><ns1:Payor>
    <ns1:ResponsibleParty>
    <ns1:AccountNumber>'.$account_number.'</ns1:AccountNumber>
    </ns1:ResponsibleParty>
    </ns1:Payor></ns1:ShippingChargesPayment>
    <ns1:RateRequestTypes>ACCOUNT</ns1:RateRequestTypes><ns1:PackageCount>1</ns1:PackageCount><ns1:RequestedPackageLineItems><ns1:SequenceNumber>1</ns1:SequenceNumber>
    <ns1:GroupPackageCount>'.$good_data['boxes'].'</ns1:GroupPackageCount>
    <ns1:Weight><ns1:Units>LB</ns1:Units><ns1:Value>'.$good_data['Weight'].'</ns1:Value></ns1:Weight>
    <ns1:Dimensions>
    <ns1:Length>'.$good_data['Length'].'</ns1:Length>
    <ns1:Width>'.$good_data['Width'].'</ns1:Width>
    <ns1:Height>'.$good_data['Height'].'</ns1:Height>
    <ns1:Units>IN</ns1:Units>
    </ns1:Dimensions>
    </ns1:RequestedPackageLineItems>
    </ns1:RequestedShipment></ns1:RateRequest></SOAP-ENV:Body></SOAP-ENV:Envelope>';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://ws.fedex.com:443/web-services');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result_xml = curl_exec($ch);
    
    // remove colons and dashes to simplify the xml
    $result_xml = str_replace(array(':','-'), '', $result_xml);
    $result = @simplexml_load_string($result_xml);
    
	$arr = $result->SOAPENVBody->RateReply->RateReplyDetails;
	
	print '<hr />';
	print '<h3>Rates for ' . $good_data['zipno'] . ':</h3><ul>';
	
	foreach($arr as $item)
	{
		if ($item->ServiceType == "FEDEX_EXPRESS_SAVER")
		{
			print '<li>'.$item->ServiceType . ' = $'. bcdiv($item->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount, '.63', 2) . '</li>';
		}
		else
		{
			print '<li>'.$item->ServiceType . ' = $'. bcdiv($item->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount, '.75', 2) . '</li>';
		}
	}
	print '</ul>';
	print '<pre>';
	print '<hr/>';
	print_r($result);
	print '</pre>';
}
?>
	</section>
</body>
</html>