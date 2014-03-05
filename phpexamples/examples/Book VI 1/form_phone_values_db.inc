<?php                                                     #1
/*  Program name: form_phone_values_db.inc  (1-4)
 *  Description:  Defines a form that gets a user's 
 *                name and phone number from the database 
 *                and displays them in a form.
 */
$labels = array ( "first_name" => "First Name",
                  "middle_name" => "Middle Name",
                  "last_name" => "Last Name",
                  "phone" => "Phone");
$submit = "Submit Phone Number";
$last_name = "Contrary";     // user name 	                #12
include("dbstuff.inc"); 	                                      #13
$cxn = mysqli_connect($host,$user,$passwd,$dbname)
         or die ("couldn't connect to server");
$query = "SELECT * FROM phone 
                   WHERE last_name='$last_name'";
$result = mysqli_query($cxn,$query)
          or die ("Couldn't execute query.".mysqli_error($cxn));
$customer = mysqli_fetch_assoc($result); 	                 #20
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
<?php
 /* Loop that displays the form fields */
  foreach($labels as $field => $label)
  {
    echo "<div id='field'><label for='$field'>$label</label>
          <input id='$field' name='$field' type='text' 
           size='50%' maxlength='65'
           value={$customer[$field]} /> </div>\n";	        #52
  }
  echo "</div>\n";
  echo "<input style='margin-left: 33%' type='submit'
          value='$submit' />\n";
?>
</form></body></html>
