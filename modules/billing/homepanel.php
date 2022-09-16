<?php
require("ismodule.php");
include "modules/$modfolder/functions_billing.php";
$zquery="SELECT * FROM b_orders WHERE uid = '$xrf_myid'";
$zresult=mysqli_query($xrf_db, $zquery);
$znum=mysqli_num_rows($zresult);

$rr=0;
while ($rr < $znum) {
$amt_due=xrf_mysql_result($zresult,$rr,"amt_due");
$amt_paid=xrf_mysql_result($zresult,$rr,"amt_paid");
$unpaid = $unpaid + ($amt_due - $amt_paid);
$rr++;
}
if ($unpaid > 0)
{
	$cash = xrfb_disp_cash($unpaid);
	$text = "Outstanding Charges:";
	$count = "<a href=\"module_page.php?modfolder=$modfolder&modpanel=orderhistory\">$cash</a>";
}
if ($unpaid == 0)
{
	$text = "View Order History";
	$count = "";
}

echo" <tr>
<td>

<a href=\"module_page.php?modfolder=$modfolder&modpanel=orderhistory\">$text</a>

</td>
<td align=\"right\">

$count

</td>
</tr>";
?>