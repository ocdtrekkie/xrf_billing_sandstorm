<?php
require("ismodule.php");
include "modules/$modfolder/functions_billing.php";
$do = $_GET['do'];
if ($do == "add")
{
$corderid = mysqli_real_escape_string($xrf_db, $_POST['corderid']);
$camount = mysqli_real_escape_string($xrf_db, $_POST['camount']);
$camount = $camount * 100;

$query="SELECT * FROM b_orders WHERE id='$corderid'";
$result=mysqli_query($xrf_db, $query);
@$amt_paid=xrf_mysql_result($result,0,"amt_paid");

$amt_paid = $amt_paid + $camount;

mysqli_query($xrf_db, "UPDATE b_orders SET amt_paid = '$amt_paid' WHERE id = '$corderid'") or die(mysqli_error($xrf_db));

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$corderid","Payment added.",2);
}
else
{
echo "<b>Add Payment to Order</b><p>";
$passid = $_GET['passid'];
if ($passid != 0)
$corderid=(int)$passid;

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addpayment&do=add\" method=\"POST\">
<table><tr><td><b>Order ID:</b></td><td><input type=\"text\" name=\"corderid\" value=\"$corderid\" size=\"10\"></td></tr>
<tr><td><b>Amount:</b></td><td><input type=\"text\" name=\"camount\" size=\"10\"> USD</td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Add\"></td></tr></table></form>";
}
?>