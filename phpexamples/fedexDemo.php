<?php
//$key = 'I1I2w1j72QNwdqzn';
//$password = 'ziK3nAI3SYWr6Lx6bXW6GggOS';
//$account_number = '510087720';
//$meter_number = '118583604';
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
<ns1:TransactionDetail><ns1:CustomerTransactionId> *** Rate Request v13 using PHP ***</ns1:CustomerTransactionId></ns1:TransactionDetail><ns1:Version><ns1:ServiceId>crs</ns1:ServiceId><ns1:Major>13</ns1:Major><ns1:Intermediate>0</ns1:Intermediate><ns1:Minor>0</ns1:Minor></ns1:Version><ns1:ReturnTransitAndCommit>true</ns1:ReturnTransitAndCommit>
<ns1:RequestedShipment>
<ns1:DropoffType>REGULAR_PICKUP</ns1:DropoffType>
<ns1:PackagingType>YOUR_PACKAGING</ns1:PackagingType>
<ns1:TotalInsuredValue><ns1:Currency>USD</ns1:Currency></ns1:TotalInsuredValue>
<ns1:Shipper><ns1:Contact><ns1:PersonName>TJ REID</ns1:PersonName><ns1:CompanyName>Vincent Printing</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines>1512 Sholar Avenue</ns1:StreetLines><ns1:City>Chattanooga</ns1:City><ns1:StateOrProvinceCode>TN</ns1:StateOrProvinceCode>
<ns1:PostalCode>37406</ns1:PostalCode><ns1:CountryCode>US</ns1:CountryCode></ns1:Address></ns1:Shipper>
<ns1:Recipient><ns1:Contact><ns1:PersonName>Recipient Name</ns1:PersonName><ns1:CompanyName>Company Name</ns1:CompanyName><ns1:PhoneNumber></ns1:PhoneNumber></ns1:Contact><ns1:Address><ns1:StreetLines></ns1:StreetLines><ns1:City></ns1:City><ns1:StateOrProvinceCode></ns1:StateOrProvinceCode>
<ns1:PostalCode>29505</ns1:PostalCode>
<ns1:CountryCode>US</ns1:CountryCode><ns1:Residential>false</ns1:Residential></ns1:Address></ns1:Recipient><ns1:ShippingChargesPayment><ns1:PaymentType>SENDER</ns1:PaymentType><ns1:Payor>
<ns1:ResponsibleParty>
<ns1:AccountNumber>'.$account_number.'</ns1:AccountNumber>
</ns1:ResponsibleParty>
</ns1:Payor></ns1:ShippingChargesPayment>
<ns1:RateRequestTypes>ACCOUNT</ns1:RateRequestTypes><ns1:PackageCount>1</ns1:PackageCount><ns1:RequestedPackageLineItems><ns1:SequenceNumber>1</ns1:SequenceNumber>
<ns1:GroupPackageCount>1</ns1:GroupPackageCount>
<ns1:Weight><ns1:Units>LB</ns1:Units><ns1:Value>6.6</ns1:Value></ns1:Weight>
<ns1:Dimensions>
<ns1:Length>16</ns1:Length>
<ns1:Width>5</ns1:Width>
<ns1:Height>16</ns1:Height>
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

print '<pre>';
print 'Rates: <br />';
//print (string) $result->SOAPENVBody->RateReply->RateReplyDetails[0]->ServiceType . ' = $' . (string) $result->SOAPENVBody->RateReply->RateReplyDetails->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;

foreach($arr as $item)
{
	print $item->ServiceType . ' = $'. bcdiv($item->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount, '.75', 2) . '<br />';

}

print '<hr/>';
print_r($result);

?>