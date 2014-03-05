<?php
/*  Program name: checkBlank.php (1-10)
 *  Description:  Program checks all the form fields for
 *                blank fields.
 */
 if(isset($_POST['sent']) && $_POST['sent'] == "yes")	    #6
 {
/* check each field except middle name for blank fields */
  foreach($_POST as $field => $value)	                    #9
  {
  if($value == "")	                                      #11
    {
      if($field != "middle_name")	                       #13
      {
         $blank_array[] = $field;	                       #15
      } // endif field is not middle name
    } // endif field is blank
    else	                                                #18
    {
      $good_data[$field] = strip_tags(trim($value));
    }
  }  // end of foreach loop for $_POST
  /* if any fields were blank, create error message and 
     redisplay form */
  if(@sizeof($blank_array) > 0)	                         #25
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
    extract($good_data);	                                 #40
    include("form_phone_values.inc");	                    #41
    exit();	                                              #42
  } // endif blanks
  echo "All required fields contain information";	        #44
 } // endif submitted
 else	                                                    #46
 {
  include("form_phone_values.inc");
 }
?>
