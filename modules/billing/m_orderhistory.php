<?php
require("ismodule.php");
include "modules/$modfolder/functions_billing.php";
echo "<p><b>Your Order History</b></p>";

$query="SELECT * FROM b_orders WHERE uid = $xrf_myid ORDER BY date DESC";
$result=mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

if ($num > 0)
{
echo "<table><tr><td width=50><b>ID</b></td><td width=100><b>Due</b><td width=200><b>Date</b></td></tr>";
$qq=0;
while ($qq < $num) {

$id=xrf_mysql_result($result,$qq,"id");
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

echo "<tr><td>$id</td><td><a href=\"module_page.php?modfolder=$modfolder&modpanel=vieworder&id=$id\">$cash</a></td><td>$date</td></tr>";
$qq++;
}

echo "</table>";
}
else
{
echo "You have no order history.";
}
?>