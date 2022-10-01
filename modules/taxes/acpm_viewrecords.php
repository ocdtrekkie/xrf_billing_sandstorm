<?php
require("ismodule.php");
require("modules/billing/functions_billing.php");

$taxyear = $_POST['taxyear'];
$taxassoc = $_POST['taxassoc'];

$taxyear = (int)$taxyear;
$taxassoc = (int)$taxassoc;

$total_expenses = 0;
$total_receipts = 0;

$query1 = "SELECT * FROM b_orders WHERE date LIKE '$taxyear%' AND aid = '$taxassoc'";
$result1=mysqli_query($xrf_db, $query1);
$num1=mysqli_num_rows($result1);
$qq=0;
while ($qq < $num1) {
	$orderid=xrf_mysql_result($result1,$qq,"id");
	$paid=xrf_mysql_result($result1,$qq,"amt_paid");
	$query2 = "SELECT * FROM b_charges WHERE oid = '$orderid'";
	$result2=mysqli_query($xrf_db, $query2);
	$num2=mysqli_num_rows($result2);
	$qz=0;
	while ($qz < $num2) {
		$iid=xrf_mysql_result($result2,$qz,"iid");
		$amt=xrf_mysql_result($result2,$qz,"amt");
		$qua=xrf_mysql_result($result2,$qz,"quantity");
		
		if ($iid == 3 || $iid == 4 || $iid == 5 || $iid == 13)
			$total_expenses = $total_expenses + $amt * $qua;
	
	$qz++;
	}
	$total_receipts = $total_receipts + $paid;

$qq++;
}
$net_income = $total_receipts - $total_expenses;

$username = xrf_get_username($xrf_db, $taxassoc);
$net = xrfb_disp_cash($net_income);
$receipts = xrfb_disp_cash($total_receipts);
$expenses = xrfb_disp_cash($total_expenses);

echo "<p align=\"left\">Associate: <b>$username</b><br>
Tax Year: <b>$taxyear</b></p>
<p align=\"left\">Total Receipts: $receipts<br>
Total Expenses: $expenses<br> <br>
Net Income: $net</p>";

?>