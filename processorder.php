<?php
// create short variable names
$tireqty = $_POST['tireqty'];
$oilqty = $_POST['oilqty'];
$sparkqty = $_POST['sparkqty'];
$find = $_POST['find'];
$address = $_POST['address'];
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
$outputstring = 0;
$date = date('H:i, jS F Y');

$totalqty = 0;
$totalamount = 0.00;
?>
<html>
<head>
<title>Bob's Auto Parts - Order Results</title>
</head>
<body>
<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>
<?php 
  if ($find=="a"){
      echo "<p>Regular customer</p>";
  }elseif ($find=="b"){
      echo "<p>Customer referred by TV advert.</p>";
  }elseif ($find=="c"){
      echo "<p>Customer referred by Phone directory.</p>";
  }elseif ($find=="d"){
      echo "<p>Customer referred by word of mouth</p>";
  }

?> 
<?php
    echo "<p>Your order is as follows: </p>";
    
    $totalqty = 0;
$totalqty = $tireqty + $oilqty + $sparkqty;

if($totalqty==0):
    echo "<font color='red'>You did not offer anything in previous page !</font>"; 
    exit;
    endif;

if ($totalqty>0) {
echo "Items ordered: ".$totalqty."<br />";
$totalamount = 0.00;
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);


$totalamount = $tireqty * TIREPRICE + $oilqty * OILPRICE+ $sparkqty * SPARKPRICE;
echo "Subtotal: $".number_format($totalamount,2)."<br />";
$taxrate = 0.10; // local sales tax is 10%
$totalamount = $totalamount * (1 + $taxrate);
echo "Total including tax: $".number_format($totalamount,2)."<br />";

    
    
echo $tireqty. " tires<br />";
echo $oilqty. " bottles of oil<br />";
echo $sparkqty. " spark plugs<br />";

echo "<p>Address to ship to is ".$address."</p>";

$outputstring = $date."\t".$tireqty." tires \t".$oilqty." oil\t"
.$sparkqty." spark plugs\t\$".$totalamount
."\t". $address."\n";

// open file for appending
@ $fp = fopen("C:\wamp\www\bob\orders\orders.txt", 'ab');
flock($fp, LOCK_EX);
if (!$fp) {
echo "<p><strong> Your order could not be processed at this time.
Please try again later.</strong></p></body></html>";
exit;
}
fwrite($fp, $outputstring, strlen($outputstring));
flock($fp, LOCK_UN);
fclose($fp);
echo "<p>Order written.</p>";

}




?>
</body>
</html>