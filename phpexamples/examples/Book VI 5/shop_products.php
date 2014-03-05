<?php
 /* Program: Shop_products.php
  * Desc:    Displays a catalog of products. Displays two
  *          different pages: an index page that shows 
  *          categories and a product page that is displayed
  *          when the customer selects a category. This 
  *          version is used with a shopping cart for
  *          purchasing items.
  */
$n_per_page = 2;                                         	#10
session_start();                                         	#11
include("dbstuff.inc");
if(isset($_POST['Products']) && 	
   isset($_POST['interest']))                            	#14
{
  if($_POST['Products'] == "Add Items to Shopping Cart")	#16
  {
     if(!isset($_SESSION['order_number']))               	#18
     {
        $cxn=mysqli_connect($host,$user,$passwd,$dbname);
        $today = date("Y-m-d");
        $sql_order = "INSERT INTO CustomerOrder (order_date) 
                       VALUES ('$today')";
        $result = mysqli_query($cxn,$sql_order)
            or die("sql_order".mysqli_error($xn));
        $order_number = mysqli_insert_id($cxn);
        $_SESSION['order_number'] = $order_number;
        $n_items = 0;
     }
     else                                                	#30
     {
        $order_number = $_SESSION['order_number'];
        $n_items = $_SESSION['n_items'];
     }
     foreach($_POST as $field => $value)                 	#35
     {
        if(substr($field,0,4) == "item" && $value > 0)   	#37
        {  
           $n_items++;
           $catalog_number = 
               substr($field,4,strlen($field)-4);        	#41
           $cxn =
               mysqli_connect($host,$user,$passwd,$dbname);
           $sql_price = "SELECT price FROM Furniture WHERE
                     catalog_number='$catalog_number'";
           $result = mysqli_query($cxn,$sql_price)
                or die("sql_price: ".mysqli_error($cxn));
           $row = mysqli_fetch_assoc($result);           	#48
           $sql_item = "INSERT INTO OrderItem
                  (order_number,item_number,catalog_number,
                   quantity,price) VALUES 
                  ($order_number,$n_items,$catalog_number,
                   $value,{$row['price']})";
           $result = mysqli_query($cxn,$sql_item)
                or die("sql_item: ".mysqli_error($cxn));
        }
     }
     $_SESSION['n_items'] = $n_items;                    	#58
     header("Location: Shop_cart.php");	                    #59
     exit();
  }
  else                                                   	#62
  {
    if(isset($_POST['n_end']))                           	#64
    {
       if($_POST['Products'] == "Previous")              	#66
       {
         $n_start = $_POST['n_end']-($n_per_page);
       }
       else                                              	#70
       {
         $n_start = $_POST['n_end'] + 1;
       }
    }
    else                                                 	#75 
    {
       $n_start = 1;
    }
    $n_end = $n_start + $n_per_page -1;                  	#79
    $cxn = mysqli_connect($host,$user,$passwd,$dbname); 
    $query_food = "SELECT * FROM Furniture WHERE 
                type='$_POST[interest]' ORDER BY name"; 
    $result = mysqli_query($cxn,$query_food)
        or die ("query_food: ".mysqli_error($cxn));      	#84
    $n=1;
    while($row = mysqli_fetch_assoc($result))            	#86
    {
       foreach($row as $field => $value)                 	#88
       {
         $products[$n][$field]=$value;
       }
       $n++;
    }
    $n_products = sizeof($products);                     	#94
    if($n_end > $n_products)
    {
      $n_end = $n_products;
    }
     include("shop_page_products.inc");
  }
}
else                                                    	#102
{
  $cxn = mysqli_connect($host,$user,$passwd,$dbname);
  $sql_cat = "SELECT DISTINCT category,type FROM Furniture 
               ORDER BY category,type"; 
  $result = mysqli_query($cxn,$sql_cat)
        or die("sql_cat: ".mysqli_error($cxn)); 
  while($row = mysqli_fetch_array($result))             	#109
  {
      $furn_categories[$row['category']][]=$row['type'];
  }
  include("shop_page_index.inc");
}
?>
