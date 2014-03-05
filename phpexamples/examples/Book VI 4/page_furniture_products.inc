<?php
  /* File:  page_furniture_products.inc
   * Desc:  Displays the products page of the catalog.
   */
 $table_heads = array("prod_number" => "Product Number", 
                      "name"         => "Item",
                      "description"  => "Description",
                      "price"        => "Price",
                      "pix"          => "Picture",
                      );
?>
<html>
<head><title>The Furniture Shop</title></head>
<body style='margin: .2in .2in 0'>
<?php                                                    	#15
echo "<h1 style='text-align: center'>The Furniture Shop</h1>
      <h2 style='size: larger'>{$_POST['interest']}</h2>\n";
echo "<p style='text-align: right'>
             ($n_products products found)</p>\n";            	#19
echo "<table style='width: 100%'>\n";
echo "<tr>\n";
foreach($table_heads as $heading)                        	#22
{
   echo "<th>$heading</th>";
}
echo "</tr>\n";
for ($i=$n_start;$i<=$n_end;$i++)                        	#27
{  
   echo "<tr>";
   echo "<td style='text-align: right; padding-right: .5in'>
         {$products[$i]['prod_number']}</td>\n";
   echo "<td>{$products[$i]['name']}</td>\n";
   echo "<td>{$products[$i]['description']}</td>\n";
   echo "<td style='text-align: center'>
                   \${$products[$i]['price']}</td>\n";
   echo "<td style='text-align: center'>
             <img src='images/{$products[$i]['pix']}'
                  width='55' height='60' /></td>\n";
   echo "</tr>\n";
}                                                        	#40
echo "<form action='$_SERVER[PHP_SELF]' method='POST'>\n"; 
echo "<input type='hidden' name='n_end' value='$n_end'>\n";
echo "<input type='hidden' name='interest'
             value='$_POST[interest]'>";                 	#44
echo "<tr><td colspan='2' style='padding: 5'> <input 
  type='submit' value='Select another category' /></td>
  <td colspan='3' style='text-align: right'>";
if($n_end > $n_per_page)                                 	#48
{
   echo "<input type='submit' name='Products'
                      value='Previous'>";
}
if($n_end < $n_products)                                 	#53
{
   echo "<input type='submit' name='Products'
                      value='Next $n_per_page'>";
}
echo "</td></tr></form></table>";                        	#58
?>
</body></html>
