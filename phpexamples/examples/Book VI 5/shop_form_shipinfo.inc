<?php
 /* File: shop_form_shipinfo.inc
  * Desc: Contains the code for a form that collects
  *       shipping information for the order.
  */
include("functions.inc");                                  	#6
include("dbstuff.inc");                                       	#7
$ship_info =  array("email"         => "Email Address",
                    "ship_name"     => "Name",
                    "ship_street"   => "Street",
                    "ship_city"     => "City",
                    "ship_state"    => "State",
                    "ship_zip"      => "Zip",
                    "phone"         => "Phone",
                    "cc_type"       => "Credit Card Type",
                    "cc_number"     => "Credit Card Number",
                    "cc_exp"        => "Expiration Date"
                   );                                     #18
$cc_types =   array("visa"          => "Visa",	
                    "mc"            => "Master Card",
                    "amex"          => "American Express"
                   );                                      #22
$length   =   array("email"         => "55",	
                    "ship_name"     => "40",
                    "ship_street"   => "55",
                    "ship_city"     => "40",
                    "ship_zip"      => "10",
                    "phone"         => "15",
                    "cc_number"     => "20"
                   );                                     #30
$months  =   array (1=> "January", "February", "March",	
                        "April", "May", "June", "July",
                        "August", "September",
                        "October", "November", "December"
                   );
$today = time("Y-m-d");                                  	#36
if(!isset($_POST) or 	
   @$_POST['Ship'] == "Edit Shipping Information" )  
{
  $cxn = mysqli_connect($host,$user,$passwd,$database);	  #40
  $sql = "SELECT
           ship_name,ship_street,ship_city,ship_state,
           ship_zip,phone,email FROM CustomerOrder WHERE 
           order_number = '{$_SESSION['order_number']}'";
  $result = mysqli_query($cxn,$sql)
         or die("Error: ".mysqli_error($cxn));
  $n = mysqli_num_rows($result);                         	#47
  if($n > 0)                                             	#48
  {
    $row = mysqli_fetch_assoc($result);
    extract($row);
  }
}                                                    
?>
 <head><title>Furniture Order: Shipping Information</title>
  <style type="text/css">
  <!--
    #form {
      margin: 1.5em 0 0 0;
      padding: 0;
    }
    #field {padding-bottom: 1em;}
    label {
      font-weight: bold;
      float: left;
      width: 20%;
      text-align: right;
      clear: left;
      margin-right; 1em;
      }
   -->
  </style>
</head>	
<h2 align='center'>Furniture Shop: Shipping Information</h2>
<p style='font-style: italic; 
    font-weight: bold'>Please fill in the information below
<?php
echo "<form action='$_SERVER[PHP_SELF]' method='POST'>	
  <div id='form'>\n";
if(isset($message))                                      	#80
{
   echo "<p style=\"font-weight: bold; font-style: italic;
             font-size: 90%; color: red\">
             $message</p>";
}
foreach($ship_info as $field => $value)                  	#86
{
  if($field == "ship_state")                             	#88
  {
     echo "<div id='field'>
           <label for '$field'>State:&nbsp;</label>
      <select name='$field' id=$field>"; 
     $stateName=getStateName();                          	#93
     $stateCode=getStateCode();
     for ($n=1;$n<=50;$n++)
     {
        $state=$stateName[$n];
        $scode=$stateCode[$n];
        echo "<option value='$scode'";
        if($scode == @$_POST['state'] ||
           $scode == @$ship_state) 
                 echo " selected";
        echo ">$state\n";
     }
     echo "</select></div>";
  }
  elseif($field == "cc_type")                           	#107
  {
     echo "<div id='field'> 
           <label for '$field'>$value:&nbsp;</label>
               <select name='cc_type'></p>"; 
     foreach($cc_types as $field => $value)            
     {
        echo "<option value='$field'";
        echo ">$value\n";
     }
     echo "</select></div>";
  }
  elseif($field == "cc_exp")                            	#119
  {
     echo "<div id='field'>
            <label for '$field'>$value:&nbsp;</label>
             <select name='cc_exp_mo'></p>";
                   for($n=1;$n<=12;$n++)
                   {
                      echo "<option
                              value='$n'>{$months[$n]}\n";
                   }
                   echo "</select>\n";
                   echo "<select name='cc_exp_da'>";
                   for($n=1;$n<=31;$n++)
                   {
                      echo " <option value='$n'>$n\n";
                   }
                   echo "</select>\n";
                   echo "<select name='cc_exp_yr'>";
                   $start_yr = date("Y",$today);
                   for($n=$start_yr;$n<=$start_yr+5;$n++)
                   {
                      echo " <option value='$n'>$n\n";
                   }
                   echo "</select></div>\n";
  }
  else                                                  	#144
  {
     echo "<div id='field'>
            <label for='$field'>$value:&nbsp;</label>
             <input type='text' id='$field' name='$field' 
                    value='".@$$field."' 
                    size='{$length[$field]}' 
                    maxsize='{$length[$field]}' />
           </div>\n";                         
  }                                             
}                                                       #154
?>
      <p style="margin-top: .05in">	
        <input style='margin-left: 33%' type="submit" 
               name="Summary" value="Continue" />
</form></body></html>
