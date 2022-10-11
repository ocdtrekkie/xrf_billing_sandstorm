<?php
require("ismodule.php");
include "modules/$modfolder/functions_billing.php";

if ($xrf_myulevel < 4)
{
xrf_go_redir("index.php","Invalid permissions.",2);
}
else
{

$do = $_GET['do'] ?? '';
if ($do == "add")
{
$descr = mysqli_real_escape_string($xrf_db, $_POST['descr']);
$longdesc = mysqli_real_escape_string($xrf_db, $_POST['longdesc']);
$defamt = mysqli_real_escape_string($xrf_db, $_POST['defamt']);
$defamt = $defamt * 100;
$catid = mysqli_real_escape_string($xrf_db, $_POST['catid']);

mysqli_query($xrf_db, "INSERT INTO b_inventory (descr, longdesc, defamt, catid) VALUES('$descr', '$longdesc', '$defamt', '$catid')") or die(mysqli_error($xrf_db));

xrf_go_redir("acp.php","Inventory added.",6);
}
else
{
echo "<b>Add New Inventory</b><p>";

$query="SELECT * FROM b_categories ORDER BY id ASC";
$result=mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addinventory&do=add\" method=\"POST\">
<table><tr><td><b>Description:</b></td><td><input type=\"text\" name=\"descr\" size=\"50\"></td></tr>
<tr><td><b>Detailed Description:</b></td><td><textarea name=\"longdesc\" rows=\"4\" cols=\"50\"></textarea></td></tr>
<tr><td><b>Default Amount:</b></td><td><input type=\"text\" name=\"defamt\" size=\"10\"></td></tr>
<tr><td><b>Category:</b></td><td><select name=\"catid\">";

$qq=0;
while ($qq < $num) {

$c_id=xrf_mysql_result($result,$qq,"id");
$c_desc=xrf_mysql_result($result,$qq,"desc");

echo "<option value='$c_id'>$c_desc</option>";

$qq++;
}

//TODO: Add category management
if ($num == 0) echo "<option value='1'>Default category</option>";

echo "</select></td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Add\"></td></tr></table></form>";
}

}
?>