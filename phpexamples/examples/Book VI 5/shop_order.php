<?php
 /* Program name:  Shop_order.php
  * Description:   Processes order when it's been submitted.
  */
session_start();                                          	#5
include("dbstuff.inc");
if(!isset($_SESSION['order_number']))                     	#7
{
   echo "No order number found<br>\n
   <a href='Shop_products.php'>Continue shopping</a>";
   exit();
}
if(@$_GET['from'] == "cart")                             	#13
{
   include("shop_form_shipinfo.inc");
   exit();
}
elseif(isset($_POST['Summary']))                         	#18
{
   foreach($_POST as $field => $value)                   	#20
   {
      if ($value == "")
      {
         $blanks[] = $field;
      }
      else
      {
        $good_data[$field] = strip_tags(trim($value));
      }
   }  
   if(isset($blanks))
   {
      $message = "The following fields are blank. 
                  Please enter the required information:  ";
      foreach($blanks as $value)
      {
         $message .="$value, ";
      }
      extract($good_data);
      include("shop_form_shipinfo.inc");
      exit();
   }
   foreach($_POST as $field => $value)                   	#43
   {
     if($field != "Summary")
     {
       if(preg_match("/name/i",$field))
       {
         if (!preg_match("/^[A-Za-z' -]{1,50}$/",$value)) 
         {
            $errors[] = "$value is not a valid name."; 
         }
       }
       if(preg_match("/street/i",$field)or 
          preg_match("/addr/i",$field) or
          preg_match("/city/i",$field))
       {
         if(!preg_match("/^[A-Za-z0-9.,' -]{1,50}$/",$value))
         {
            $errors[] = "$value is not a valid address
                          or city.";
         }
       }
       if(preg_match("/state/i",$field))
       {
         if(!preg_match("/[A-Za-z]/",$value))
         {
            $errors[] = "$value is not a valid state.";
         }
       }
       if(preg_match("/email/i",$field))
       {
         if(!preg_match("/^.+@.+\\..+$/",$value))
         {
            $errors[]="$value is not a valid email address.";
         }
       }
       if(preg_match("/zip/i",$field))
       {
         if(!preg_match("/^[0-9]{5,5}(\-[0-9]{4,4})?$/",
                        $value))
         {
            $errors[] = "$value is not a valid zipcode.";
         }
       }
       if(preg_match("/phone/i",$field))
       {
         if(!preg_match("/^[0-9)(xX -]{7,20}$/",$value))
         {
            $errors[]="$value is not a valid phone number. ";
         }
       }
       if(preg_match("/cc_number/",$field))
       {
         $value = trim($value);
         $value = ereg_replace(' ','',$value);
         $value = ereg_replace('-','',$value);
         $_POST['cc_number'] = $value;
         if($_POST['cc_type'] == "visa") 
         {
           if(!preg_match("/^[4]{1,1}[0-9]{12,15}$/",$value)) 
           {
             $errors[]="$value is not a valid Visa number. ";
           }
         }
         elseif($_POST['cc_type'] == "mc")
         {
           if(!preg_match("/^[5]{1,1}[0-9]{15,15}$/",$value))
           {
             $errors[] = "$value is not a valid 
                           Mastercard number. ";
           }
         }
         else 
         {
           if(!preg_match("/^[3]{1,1}[0-9]{14,14}$/",$value))
           { 
             $errors[] = "$value is not a valid 
                           American Express number. ";
           }
         }
       }
       $$field = strip_tags(trim($value));              	#123
     }
   }                                                    	#125
   if(@is_array($errors))                               	#126
   {  
      $message = "";                                    	#128
      foreach($errors as $value)
      {
         $message .= $value." Please try again<br />";
      }                                                 	#132
      include("shop_form_shipinfo.inc");                	#133
      exit();
   }                                                    	#135
    /* Process data when all fields are correct */
   $cxn = mysqli_connect($host,$user,$passwd,$dbname);
   foreach($_POST as $field => $value)                  	#138
   {
      if(!eregi("cc_",$field) && $field != "Summary" )	  #140
      {
         $value = mysqli_real_escape_string($cxn,$value);
         $updates[] = "$field = '$value'";
      }
   }
   $update_string = implode($updates,",");              	#146
   $sql_ship = "UPDATE CustomerOrder SET $update_string	#147
          WHERE order_number='{$_SESSION['order_number']}'";
   $result = mysqli_query($cxn,$sql_ship)
                 or die(mysqli_error($cxn));
   extract($_POST);                                     	#151
   include("shop_page_summary.inc");
}
elseif(isset($_POST['Ship']))                           	#154
{
   include("shop_form_shipinfo.inc");
}
elseif(isset($_POST['Final']))                         	#158
{
   switch ($_POST['Final'])                            	#160
   {
      case "Continue Shopping":                        	#162
         header("Location: Shop_products.php");
         break;
      case "Cancel Order":                             	#165
         #include("shop_page_cancel.inc");
         unset($_SESSION['order_number']);
         session_destroy();
         exit();
         break;
      case "Submit Order":                             	#171
         $cxn = 
            mysqli_connect($host,$user,$password,$database);
         $sql = "UPDATE CustomerOrder SET submitted='yes'
           WHERE order_number='{$_SESSION['order_number']}'";
         $result = mysqli_query($cxn,$sql)
                or die("Error: ".mysqli_error($cxn));
         #processCCInfo();                             	#178
         #sendOrder();	#179
         #include("shop_page_accept.inc");             	#180
         #email();                                     	#181
         session_destroy();                            	#182
         break;
    }
}
?>
