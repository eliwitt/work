<?php
/*  Program name: form_radio.inc
 *  Description:  Program displays a list of radio
 *                buttons from database info.
 */
 echo "<html>
       <head><title>Radio Buttons</title></head>
       <body>";
 include("dbstuff.inc");
 $cxn = mysqli_connect($host,$user,$passwd,$dbname)
        or die ("Couldn't connect to server");
 $query = "SELECT DISTINCT cat FROM Product
                  ORDER BY cat";
 $result = mysqli_query($cxn,$query)
           or die ("Couldn't execute query.");

 echo "<div style='margin-left: .5in; margin-top: .5in'>
       <p style='font-weight: bold'>
        Which type of product are you interested in?</p>
       <p>Please choose one category from the 
          following list:</p>\n";

 /* create form containing radio buttons */
 echo "<form action='process_form.php' method='POST'>\n";
 while($row = mysqli_fetch_assoc($result))
 {
    extract($row);
    echo "<input type='radio' name='category' 
                 value='$cat' />$cat\n";
    echo "<br />\n";
 }
 echo "<p><input type='submit' value='Select category' />
      </form></div>\n";
?>
</body></html>
