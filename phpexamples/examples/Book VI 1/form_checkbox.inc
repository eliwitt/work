<?php
/*  Program name: form_checkbox.inc
 *  Description:  Program displays a list of 
 *                checkboxes from database info.
 */
  echo "<html>
        <head><title>Checkboxes</title></head>
        <body style='margin: .5in'>";
  include("dbstuff.inc");
  $cxn = mysqli_connect($host,$user,$passwd,$dbname)
         or die ("couldn't connect to server");
  $query = "SELECT DISTINCT cat FROM Product
                   ORDER BY cat";
  $result = mysqli_query($cxn,$query)
            or die ("Couldn't execute query.");

  echo "<h3>Which products are you interested in?
         <span style='font-size: 80%; font-weight: normal'>
         (Check as many as you want)</span></h3>\n";

  /* create form containing checkboxes */
  echo "<fieldset>
        <legend style='font-weight: bold'>Products</legend>
        <form action='process_form.php' method='POST'>
        <ul style='list-style: none'>\n";
  while($row = mysqli_fetch_assoc($result))
  {
     extract($row);
     echo "<li><input type='checkbox' name='interest[$cat]' 
                id='$cat' value='$cat' />
                <label for='$cat' 
                   style='font-weight: bold'>$cat</label>
           </li>\n";
  }
  echo "</ul></fieldset>";
  echo "<p><input type='submit' 
                  value='Select Categories' /></p>
        </form></body></html>\n";
?>
