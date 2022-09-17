<?php
require("ismodule.php");
require("includes/functions_bbc.php");
require("modules/$modfolder/functions_billing.php");
$id=(int)$_GET['id'];
xrfb_update_order($xrf_db, $id);
$query="SELECT * FROM b_orders WHERE id='$id'";
$result=mysqli_query($xrf_db, $query);
$customer=xrf_mysql_result($result,0,"customer");
$date=xrf_mysql_result($result,0,"date");
$aid=xrf_mysql_result($result,0,"aid");
$notes=xrf_mysql_result($result,0,"notes");
$amt_taxes=xrf_mysql_result($result,0,"amt_taxes");
$amt_due=xrf_mysql_result($result,0,"amt_due");
$amt_paid=xrf_mysql_result($result,0,"amt_paid");
$closed=xrf_mysql_result($result,0,"closed");
$notes=xrf_bbcode_format($notes);
$ausername = xrf_get_username($xrf_db, $aid);

$queryy="SELECT * FROM b_charges WHERE oid='$id'";
$resulty=mysqli_query($xrf_db, $queryy);
$num=mysqli_num_rows($resulty);

echo "<p align=\"left\"><b>Order #$id</b><br><b>$customer<br>$date</b><br>Associate: $ausername</p><p align=\"left\">Notes: $notes</p><p><table>
<tr><td width=420><b>Item</b></td><td width=\"80\" align=\"right\"><b>Charge</b></td><td width=\"80\" align=\"right\"><b>Quantity</b></td><td width=\"80\" align=\"right\"><b>Amount</b></td></tr>";
$qq=0;
while ($qq < $num) {

$iid=xrf_mysql_result($resulty,$qq,"iid");
$amt=xrf_mysql_result($resulty,$qq,"amt");
$quantity=xrf_mysql_result($resulty,$qq,"quantity");
$status=xrf_mysql_result($resulty,$qq,"status");
$iname=xrfb_get_item_name($xrf_db, $iid);
$cash = xrfb_disp_cash($amt);

if ($status != "W")
{
$total = $total + ($amt * $quantity);
$status2 = xrfb_disp_cash($amt * $quantity);
}
if ($status == "W")
$status2 = "Waived";

echo "<tr><td>$iname</td><td align=\"right\">$cash</td><td align=\"center\"> x $quantity</td><td align=\"right\">$status2</td></tr>";
$qq++;
}

$subtotal = xrfb_disp_cash($total);
$taxes = xrfb_disp_cash($amt_taxes);
$due = xrfb_disp_cash($amt_due);
$paid = xrfb_disp_cash($amt_paid);
$owed = xrfb_disp_cash($amt_due - $amt_paid);
if ($closed == 0) { $modifylinks = " <a href=\"acp_module_panel.php?modfolder=billing&modpanel=addcharge&passid=$id\">[Add Charge]</a> <a href=\"acp_module_panel.php?modfolder=billing&modpanel=addpayment&passid=$id\">[Add Payment]</a> <a href=\"acp_module_panel.php?modfolder=billing&modpanel=closeorder&passid=$id\">[Close Order]</a>"; }
echo "</table></p><p align=\"right\"><table><tr><td width=\"100\">Subtotal:</td><td align=\"right\" width=\"100\">$subtotal</td></tr>
<tr><td>Taxes:</td><td align=\"right\">$taxes</td></tr></table></p>
<p align=\"right\"><table><tr><td width=\"100\">Total:</td><td align=\"right\" width=\"100\">$due</td></tr>
<tr><td>Paid:</td><td align=\"right\">$paid</td></tr>
<tr><td><b>Unpaid:</b></td><td align=\"right\"><b>$owed</b></td></tr></table></p>

<p align=\"left\" class=\"actions-bar\"><b>Actions:</b> <font size=\"2\"><a href=\"acp_module_panel.php?modfolder=billing&modpanel=editorder&passid=$id\">[Edit Order]</a>$modifylinks [E-Mail Receipt] [Print Invoice]</font></p>";
?>