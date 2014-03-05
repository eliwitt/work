<?php
/*  Program name: form_select.inc
 *  Description:  file builds a selection list 
 *                from the database.
 */
?>
<html>
<head><title>Categories</title></head>
<body>
<?php
 include("dbstuff.inc");
 $cxn = mysqli_connect($host,$user,$passwd,$dbname)
        or die ("couldn't connect to server");
 $query = "SELECT DISTINCT cat FROM Product ORDER BY cat";
 $result = mysqli_query($cxn,$query)
           or die ("Couldn't execute query.");
 /* create form containing selection list */
 echo "<form action='process_form.php' method='POST'
             style='margin-left: 2em'>
       <label for='cat' 
              style='font-weight: bold'>Category:</label>
        <select id='cat' name='cat' 
                style='margin-top: 3em'>\n";
 while($row = mysqli_fetch_assoc($result))
 {
    extract($row);
    echo "<option value='$cat' />$cat\n</option>";
 }
 echo "</select>\n";
 echo "<input type='submit' style='margin-left: 3em'
              value='Select category' />
       </form>\n";
?>
</body></html>
