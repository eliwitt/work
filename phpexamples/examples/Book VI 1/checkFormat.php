<?php
/*  Program name: checkFormat.php
 *  Description:  Program checks all the form fields for
 *                valid formats.
 */
 if(isset($_POST['sent']) && $_POST['sent'] == "yes")	    #6
{
 /* validate data from the form */
  foreach($_POST as $field => $value)	                    #9
  {
    if(!empty($value))	                                  #11
    {
      $name_patt = "/^[A-Za-z' -]{1,50}$/";	#13
      $phone_patt = "/^[0-9)(xX -]{7,20}$/";
      if(preg_match("/name/i",$field))	                 #15
      {
         if(!preg_match($name_patt,$value))	            #17
         {
           $error_array[] = "$value is not a valid name";
           $bad_data[$field] = strip_tags(trim($value));
         }
         else	                                          #22
         {
           $good_data[$field] = strip_tags(trim($value));
         }
      }  // endif name format check
      if(preg_match("/phone/i",$field))	                #27
      {
         if(!preg_match($phone_patt,$value))
         {
           $error_array[] = "$value is not a 
                              valid phone number";
           $bad_data[$field] = strip_tags(trim($value));
         }
         else
         {
           $good_data[$field] = strip_tags(trim($value));
         }
      }  // endif phone format check
    } // endif not blank
  }  // end of foreach loop for $_POST
  /* if any fields were invalid, create error message and 
     redisplay form */
  if(@sizeof($error_array) > 0) // errors are found	    #44
  {
   /* create error message */
    $message = "<ul style='color: red; list-style: none' >";
    foreach($error_array as $value)
    {
      $message .= "<li>$value</li>";
    }
    $message .= "</ul>"; 
   /* redisplay form */
    extract($good_data);	                               #54
    extract($bad_data);
    include("form_phone_values.inc");
    exit();	#57
  } // end if blanks
  echo "All required fields contain valid information";	#59
} // end if submitted
else	                                                   #61
{
  include("form_phone_values.inc");
}
?>
