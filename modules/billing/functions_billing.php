<?php

//Function xrfb_disp_cash
//Use: Displays money as a cash string
function xrfb_disp_cash($amt)
{
$cash = $amt / 100;
$cash = sprintf("%.2f", $cash);
$cash = "$" . $cash;
return ($cash);
}

//Function xrfb_get_category_name
//Use: Gets category name from category id
function xrfb_get_category_name($xrf_db, $cid)
{
$query="SELECT * FROM b_categories WHERE id='$cid'";
$result=mysqli_query($xrf_db, $query);
if (mysqli_num_rows($result) > 0) { $desc=xrf_mysql_result($result,0,"desc"); }
else { $desc="Default category"; }
return ($desc);
}

//Function xrfb_get_item_name
//Use: Gets item name from item id
function xrfb_get_item_name($xrf_db, $iid)
{
$query="SELECT * FROM b_inventory WHERE id='$iid'";
$result=mysqli_query($xrf_db, $query);
$descr=xrf_mysql_result($result,0,"descr");
return ($descr);
}

//Function xrfb_get_tax_rate
//Use: Gets tax rate
function xrfb_get_tax_rate($xrf_db)
{
$query="SELECT * FROM b_config";
$result=mysqli_query($xrf_db, $query);
$taxr=xrf_mysql_result($result,0,"tax_rate");
return ($taxr);
}

//Function xrfb_update_order
//Use: Updates amount due on an order
function xrfb_update_order($xrf_db, $oid)
{
$query="SELECT * FROM b_config";
$result=mysqli_query($xrf_db, $query);
$taxr=xrf_mysql_result($result,0,"tax_rate");

$query="SELECT * FROM b_orders WHERE id='$oid'";
$result=mysqli_query($xrf_db, $query);
$closed=xrf_mysql_result($result,0,"closed");
$odate=xrf_mysql_result($result,0,"date");
$amt_due=xrf_mysql_result($result,0,"amt_due");
$amt_paid=xrf_mysql_result($result,0,"amt_paid");

/* We'll make this manual later

if ($closed != 1 && $amt_due - $amt_paid == 0)
{
	$chkdate = strtotime($odate);

	$diff = time() - $chkdate;
	if ($diff > 60*60*24*30)
	{
		$query="UPDATE b_orders SET closed = '1' WHERE id='$oid'";
		mysqli_query($xrf_db, $query);
	}
}*/

if ($closed != 1)
{
	$query="SELECT * FROM b_charges WHERE oid='$oid'";
	$result=mysqli_query($xrf_db, $query);
	$num=mysqli_num_rows($result);

	$i = 0; $totalamount = 0;
	while ($i < $num) {
		$amt=xrf_mysql_result($result,$i,"amt");
		$quantity=xrf_mysql_result($result,$i,"quantity");
		$status=xrf_mysql_result($result,$i,"status");
		if ($status != 'W')
		$totalamount = $totalamount + ($amt * $quantity);
		$i++;
	}
	$amttaxes = $totalamount * ($taxr / 100);
	$totalamount = $totalamount + $amttaxes;
	$query="UPDATE b_orders SET amt_taxes = '$amttaxes', amt_due = '$totalamount' WHERE id='$oid'";
	mysqli_query($xrf_db, $query);
}
}

?>