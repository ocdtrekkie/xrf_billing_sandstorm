<?php
require("ismodule.php");
include "modules/$modfolder/functions_billing.php";
$do = $_GET['do'];
if ($do == "add")
{
$corderid = mysqli_real_escape_string($xrf_db, $_POST['corderid']);
$ccharge = mysqli_real_escape_string($xrf_db, $_POST['ccharge']);
$camount = mysqli_real_escape_string($xrf_db, $_POST['camount']);
$cquantity = mysqli_real_escape_string($xrf_db, $_POST['cquantity']);
$cstatus = mysqli_real_escape_string($xrf_db, $_POST['cstatus']);
$camount = $camount * 100;
if ($cstatus == 'N')
$cstatus = "";

$query="SELECT * FROM b_orders WHERE id='$corderid'";
$result=mysqli_query($xrf_db, $query);
@$ccustomer=xrf_mysql_result($result,0,"customer");

mysqli_query($xrf_db, "INSERT INTO b_charges (customer, oid, iid, amt, quantity, status) VALUES('$ccustomer', '$corderid', '$ccharge', '$camount', '$cquantity', '$cstatus')") or die(mysqli_error($xrf_db));
xrfb_update_order($xrf_db, $corderid); 

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$corderid","Charge added.",6);

echo "<p>Need to <a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addcharge&passid=$corderid\">add another charge?</a></p>";
}
else
{
echo "<b>Add New Charge</b><p>";

$query="SELECT * FROM b_inventory ORDER BY catid, id ASC";
$result=mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);
$passid = $_GET['passid'];
if ($passid != 0)
$corderid=(int)$passid;

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addcharge&do=add\" method=\"POST\">
<table><tr><td><b>Order ID:</b></td><td><input type=\"text\" name=\"corderid\" value=\"$corderid\" size=\"10\"></td></tr>
<tr><td><b>Charge:</b></td><td><select name=\"ccharge\">";

$qq=0;
while ($qq < $num) {

$c_id=xrf_mysql_result($result,$qq,"id");
$c_descr=xrf_mysql_result($result,$qq,"descr");
$c_amt=xrf_mysql_result($result,$qq,"defamt");
$c_amt = $c_amt / 100;
$cash = "$" . sprintf("%.2f", $c_amt);

echo "<option value='$c_id'>$c_descr - $cash</option>";

$qq++;
}

echo "</select></td></tr>
<tr><td><b>Amount and Quantity:</b></td><td><input type=\"text\" name=\"camount\" size=\"10\"> USD x <input type=\"text\" name=\"cquantity\" value=\"1\" size=\"5\"></td></tr>
<tr><td><b>Waived?</b></td><td><select name=\"cstatus\"><option value=\"N\">No</option><option value=\"W\">Yes</option></select></td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Add\"></td></tr></table></form>";
}
?>