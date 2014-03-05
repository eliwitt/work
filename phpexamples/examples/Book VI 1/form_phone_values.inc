<?php
/*  Program name: form_phone_values.inc
 *  Description:  Defines a form that collects a user's 
 *                name and phone number.
 */
$labels = array( "first_name" => "First Name",
                 "middle_name" => "Middle Name",
                 "last_name" => "Last Name",
                 "phone" => "Phone");
$submit = "Submit Phone Number";
?>
 <html>
 <head><title>Customer Phone Number</title>
    <style type='text/css'>
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
     margin-right: 1em;
     text-align: right;
     }
    -->
   </style>
 </head>
 <body>
<h3>Please enter your phone number below.</h3>
<?php
 echo "<form action='$_SERVER[PHP_SELF]' method='POST'>	
      <div id='form'>";
  if(isset($message))	                                     #36
  {
     echo $message;
  }
  /* Loop that displays the form fields */
  foreach($labels as $field => $label)
  {
    echo "<div id='field'><label for='$field'>$label</label>
          <input id='$field' name='$field' type='text' 
             size='50%' maxlength='65' 
             value='".@$$field."' /></div>\n";	            #46
  }
  echo "<input type='hidden' name='sent' value='yes' />\n";	 #48
  echo "<input style='margin-left: 33%' type='submit'
          value='$submit' />\n";
?>
</form></body></html>
