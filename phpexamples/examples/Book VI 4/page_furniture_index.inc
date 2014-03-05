<?php	#1
  /* File:  page_furniture_index.inc
   * Desc:  Displays the categories for the catalog.
   */
?>
<html>
<head><title>The Furniture Shop</title>
     <style type='text/css'>
       <!--
       ul li {
         list-style: none; 
         font-weight: bold; 
         padding-top: .5em;
         font-size: 1.2em;
         }
       ul li.level2 {
         margin-left: -1em;
         font-weight: normal;
         font-size: .9em;
         }
        -->
     </style>
</head>  
<body style="margin: .2in">
<?php	
 echo "<h1 style='text-align: center'>The Furniture Shop</h1>
       <hr />";
 /* Create form containing selection list */
 echo "<form action='$_SERVER[PHP_SELF]' method='POST'>\n";
 echo "<ul>\n"; 
 foreach($furn_categories  as $key => $subarray)	#31
 {
    echo "<li>$key</li>\n";	#33
    echo "<ul>\n";	#34
    foreach($subarray as $type)	#35
    {
      echo "<li class='level2'>	
              <input type='radio' name='interest' 
                     id='$type' value='$type' />
              <label for='$type'>$type</label></li>\n";
    } // end foreach type	#41
    echo "</ul>\n";	#42
 } //end foreach category
 echo "</ul>";	#44
 echo "<input type='submit' name='Products' 
       value='Select Category' 
       style='margin-left: .5in' />\n";
 echo "</form>\n";
?>
<hr>
</body></html>
