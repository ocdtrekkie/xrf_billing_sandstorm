<?php
require("ismodule.php");
require("modules/$modfolder/functions_billing.php");
$do = $_GET['do'] ?? '';
if ($do == "edit")
{
$id = $_POST['id'];
$id = (int)$id;
$customer = mysqli_real_escape_string($xrf_db, $_POST['customer']);
$date = mysqli_real_escape_string($xrf_db, $_POST['date']);
$notes = mysqli_real_escape_string($xrf_db, $_POST['notes']);
$clsdchk = (int)mysqli_real_escape_string($xrf_db, $_POST['clsdchk']);

xrfb_update_order($xrf_db, $id);

mysqli_query($xrf_db, "UPDATE b_orders SET customer = '$customer', date = '$date', notes = '$notes', closed = $clsdchk WHERE id = '$id'") or die(mysqli_error($xrf_db)); 

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$id","Order edited.",2);
}
else
{
$passid = $_GET['passid'];
$id=(int)$passid;
echo "<b>Edit Invoice</b><p>";

$query="SELECT * FROM b_orders WHERE id='$id'";
$result=mysqli_query($xrf_db, $query) or die(mysqli_error($xrf_db));
$customer=xrf_mysql_result($result,0,"customer");
$date=xrf_mysql_result($result,0,"date");
$notes=xrf_mysql_result($result,0,"notes");
$closed=xrf_mysql_result($result,0,"closed");
$clsdy = ""; $clsdn = "";
if ($closed == 1)
		$clsdy = " checked";
	else
		$clsdn = " checked";

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=editorder&do=edit\" method=\"POST\">
<table><tr><td><b>Customer Name:</b></td><td><input type=\"text\" name=\"customer\" value=\"$customer\" size=\"50\" required> <input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"Save Changes\"></td></tr>
<tr><td><b>Date of Invoice:</b></td><td><input type=\"date\" name=\"date\" value=\"$date\" required></td></tr>
<tr><td><b>Notes:</b></td><td><textarea name=\"notes\" rows=\"8\" cols=\"50\">$notes</textarea></td></tr>
<tr><td><b>Status:</b></td><td><input type=\"radio\" name=\"clsdchk\" value=0$clsdn> Open <input type=\"radio\" name=\"clsdchk\" value=1$clsdy> Closed</td></tr>
</table></form>";
}
?>