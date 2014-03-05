<?php 	                                                   #1
/*  Program name: phone_form.inc (1-3)
 *  Description:  Defines a form that collects a user's 
 *                name and phone number.
 */
$labels = array( "first_name" => "First Name",            #6
                 "middle_name" => "Middle Name",
                 "last_name" => "Last Name",
                 "phone" => "Phone");
$submit = "Submit Phone Number";                          #10
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
<form action='process_form.php' method='POST'>
<div id='form'>
<?php                                                    #35
  /* Loop that displays the form fields */
  foreach($labels as $field => $label)                   #37
  {
    echo "<div id='field'><label for='$field'>$label</label>
          <input id='$field' name='$field' type='text' 
                 size='50%' maxlength='65' /></div>\n";
  }                                                      #42 
  echo "</div>\n";
  echo "<input style='margin-left: 33%' type='submit'
          value='$submit' />\n";
?>
</form></body></html>
