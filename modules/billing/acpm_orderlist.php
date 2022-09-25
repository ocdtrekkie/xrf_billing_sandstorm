<?php
require("ismodule.php");
$condition="";
$cndlbl="";
include "modules/$modfolder/functions_billing.php";
$filter = $_GET['filter'];
if ($filter == "open")
{
	$condition = " WHERE closed = '0'";
	$cndlbl = "Open";
}
if ($filter == "closed")
{
	$condition = " WHERE closed = '1'";
	$cndlbl = "Closed";
}
if ($cndlbl == "")
	$cndlbl = "All";

echo "<p align=\"left\" class=\"actions-bar\"><b>Actions:</b> <font size=\"2\"><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addorder\">[Create New Invoice]</a></font></p><p><b>$cndlbl Invoices</b></p>";

$query="SELECT * FROM b_orders$condition ORDER BY date DESC";
$result=mysqli_query($xrf_db, $query);

$num=mysqli_num_rows($result);

echo "<table><tr><td width=50><b>ID</b></td><td width=200><b>Customer</b></td><td width=100><b>Due</b><td width=200><b>Date</b></td></tr>";
$qq=0;
while ($qq < $num) {

$id=xrf_mysql_result($result,$qq,"id");
$customer=xrf_mysql_result($result,$qq,"customer");
$date=xrf_mysql_result($result,$qq,"date");
$amt_due=xrf_mysql_result($result,$qq,"amt_due");
$amt_paid=xrf_mysql_result($result,$qq,"amt_paid");

$due = $amt_due - $amt_paid;
if($due <= 0)
$cash = "Paid";
else
{
$cash = xrfb_disp_cash($due);
}

echo "<tr><td><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$id\">$id</a></td><td><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$id\">$customer</a></td><td><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$id\">$cash</a></td><td>$date</td></tr>";
$qq++;
}

echo "</table>";
?>