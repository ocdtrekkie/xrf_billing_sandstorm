<?php
require("ismodule.php");
$do = $_GET['do'];
if ($do == "add")
{
$customer = mysqli_real_escape_string($xrf_db, $_POST['customer']);
$date = mysqli_real_escape_string($xrf_db, $_POST['date']);
$notes = mysqli_real_escape_string($xrf_db, $_POST['notes']);
$aid = $_POST['assoc'];
$aid = (int)$aid;

$query="SELECT * FROM g_users WHERE email='$customer' || id='$customer'";
$result=mysqli_query($xrf_db, $query);
@$custid=xrf_mysql_result($result,0,"id");

mysqli_query($xrf_db, "INSERT INTO b_orders (uid, date, aid, notes) VALUES('$custid', '$date', '$aid', '$notes')") or die(mysqli_error($xrf_db));
$oid = mysqli_insert_id($xrf_db);

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$oid","Order created.",2);
}
else
{
echo "<b>Create New Order</b><p>";
$currentdate = date("Y-m-d H:i:s");
echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addorder&do=add\" method=\"POST\">
<table><tr><td><b>Customer ID or Email:</b></td><td><input type=\"text\" name=\"customer\" size=\"50\"> <input type=\"submit\" value=\"Create\"></td></tr>
<tr><td><b>Date of Order:</b></td><td><input type=\"text\" name=\"date\" value=\"$currentdate\" size=\"50\">
<tr><td><b>Order Notes:</b></td><td><textarea name=\"notes\" rows=\"8\" cols=\"50\"></textarea></td></tr>
<tr><td><b>Associate:</b></td><td><select name=\"assoc\">";

$queryq="SELECT * FROM g_users WHERE ulevel > 2";
$resultq=mysqli_query($xrf_db, $queryq);
$num=mysqli_num_rows($resultq);

$qq=0;
while ($qq < $num) {

$aid=xrf_mysql_result($resultq,$qq,"id");
$ausername=xrf_mysql_result($resultq,$qq,"username");
echo "<option value=\"$aid\">$ausername</option>";

$qq++;
}

echo "</select></td></tr></table></form>";
}
?>