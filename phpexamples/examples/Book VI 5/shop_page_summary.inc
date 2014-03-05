<?php
 /*File:   shop_page_summary.inc
  *Desc:   Defines an HTML page that displays a summary 
  *        of the order.
  */
include("dbstuff.inc");
$table_headers = array( "Item","Cat No","Furniture",	   #7
                        "Amount","Price","Total");         #8 
$order_number = $_SESSION['order_number'];               	#9
$shipping_rate = .25;                                   	#10
$table_name = $order_number;                            	#11
$cxn = mysqli_connect($host,$user,$passwd,$dbname);  	   #12
$sql_ord = "SELECT * FROM OrderItem 
                     WHERE order_number='$order_number'";
$result = mysqli_query($cxn,$sql_ord)
    or die("sql_ord: ".mysqli_error($cxn));
$n_row = mysqli_num_rows($result);	#17
if($n_row < 1)                                          	#18
{
   echo "Shopping Cart is currently empty<br>\n
          <a href='Shop_products.php'>Continue Shopping</a>\n";
   exit();
}
$n=1;                                                   	#24
while($row = mysqli_fetch_assoc($result))	#25
{
   foreach($row as $field => $value)
   {
      if($field != "order_number")
      {
         $items[$n][$field]=$value;
         if($field == "catalog_number")
         {
           $sql_name = "SELECT name,type FROM furniture WHERE 
                   catalog_number = '$row[catalog_number]'";
           $result2 = mysqli_query($cxn,$sql_name)
              or die("sql_name: ".mysqli_error($cxn));
           $row = mysqli_fetch_row($result2);
           $items[$n]["name"]=$row[0]." ".$row[1];
         }
      }
   }
   $n++;
}                                                         #44
echo "<html>	
      <head><title>Order Summary</title></head>\n
      <body>\n";
echo "<h2 style='text-align: center'>Order Summary</h2>\n";
echo "<p style='position: absolute; margin-top: .25in; 
                font-weight: bold'>Ship to:</p>";      
echo "<p style='position: absolute; margin-top: .25in;
                margin-left: .75in'>$ship_name<br>";
echo "$ship_street<br>
      $ship_city, $ship_state $ship_zip<br>
      $phone<br>
      $email<br>";                                       	#56
echo "<div style='margin-top: 1.5in'>";	                    #57
echo "<p style='font-weight: bold'>Order Number: $table_name";
echo "<table border = '0' style='width: 100%'>\n";
echo "<form action='$_SERVER[PHP_SELF]' method='POST'>";
echo "<tr>";
foreach($table_headers as $header)                          #62
{
   echo "<th>$header</th>\n";
}
echo "</tr>";
for($i=1;$i <=sizeof($items);$i++)                      	#67
{
   echo "<tr>";
   echo "<td width='10%' align='center'>$i</td>";
   echo "<td width='10%' align='center'>
             {$items[$i]['catalog_number']}</td>";
   echo "<td style='padding-left: 1em'>{$items[$i]['name']}
         </td>";
   echo "<td align='center'>{$items[$i]['quantity']}</td>";
   $f_price = number_format($items[$i]['price'],2);
   echo "<td style='text-align: right; width: 17%; 
             padding-right: 2em'>$$f_price</td>\n";
   $total = $items[$i]['quantity'] * $items[$i]['price'];
   $f_total = number_format($total,2);
   echo "<td style='text-align: right'>$$f_total</td>\n";
   echo "</tr>";
   @$order_subtotal = $order_subtotal + $total;
}
$f_order_subtotal = number_format($order_subtotal,2);	   #85
if(substr($ship_zip,0,5) > 75000 	#86
          && substr($ship_zip,0,5) < 80000)               #87 
{
   $taxrate = .0700;
}
else
{
   $taxrate = 0.0;
}                                                       	#94
$sales_tax = $order_subtotal * $taxrate;                	#95
$f_sales_tax = number_format($sales_tax,2);
$shipping = $shipping_rate * sizeof($items);            	#97
$f_shipping = number_format($shipping,2);
$order_total = $order_subtotal + $sales_tax + $shipping;	#99
$f_order_total = number_format($order_total,2);            #100
echo "<tr><td colspan='5' style='text-align: right;        #101
                   font-weight: bold'>Subtotal</td>
          <td style='text-align: right; line-height: 200%'>
              $$f_order_subtotal</td></tr>\n";
echo "<tr><td colspan='5' 
           style='text-align: right; font-weight: bold'>
             Sales Tax</td>
          <td style='text-align: right; line-height: 50%'>
             $$f_sales_tax</td></tr>\n";
echo "<tr><td colspan='5' style='text-align: right; 
                  font-weight: bold'>Shipping</td>
          <td style='text-align: right; line-height: 50%'>
             $$f_shipping</td></tr>\n";
echo "<tr><td colspan='5' 
           style='text-align: right; font-weight: bold'>
             Total</td>
          <td style='text-align: right; line-height: 300%'>
             $$f_order_total</td></tr>\n";
echo "<tr><td colspan='2' style='text-align: left'>
             <input type='submit' name='Final'  
                    value='Continue Shopping'></td>\n";
echo "    <td colspan='1' style='text-align: center'>
             <input type='submit' name='Ship' 
                  value='Edit Shipping Information'></td>\n";
echo "    <td colspan='1' style='text-align: right'>
             <input type='submit' name='Final' 
                    value='Cancel Order'></td>\n";
echo "    <td colspan='2' style='text-align: right'>
             <input type='submit' name='Final' 
                    value='Submit Order'></td>\n";
echo "</tr></table></form>\n"; 
?>
