<?php
require("ismodule.php");
require("modules/$modfolder/functions_billing.php");
$do = $_GET['do'];
if ($do == "edit")
{
$id = $_POST['id'];
$id = (int)$id;
$notes = mysqli_real_escape_string($xrf_db, $_POST['notes']);
$clsdchk = (int)mysqli_real_escape_string($xrf_db, $_POST['clsdchk']);

xrfb_update_order($xrf_db, $id);

mysqli_query($xrf_db, "UPDATE b_orders SET notes = '$notes', closed = $clsdchk WHERE id = '$id'") or die(mysqli_error($xrf_db)); 

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
$notes=xrf_mysql_result($result,0,"notes");
$closed=xrf_mysql_result($result,0,"closed");
if ($closed == 1)
		$clsdy = " checked";
	else
		$clsdn = " checked";

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=editorder&do=edit\" method=\"POST\">
<table><tr><td><b>Customer:</b></td><td>$customer <input type=\"hidden\" name=\"id\" value=\"$id\"><input type=\"submit\" value=\"Save Changes\"></td></tr>
<tr><td><b>Notes:</b></td><td><textarea name=\"notes\" rows=\"8\" cols=\"50\">$notes</textarea></td></tr>
<tr><td><b>Status:</b></td><td><input type=\"radio\" name=\"clsdchk\" value=0$clsdn> Open <input type=\"radio\" name=\"clsdchk\" value=1$clsdy> Closed</td></tr>
</table></form>";
}
?>