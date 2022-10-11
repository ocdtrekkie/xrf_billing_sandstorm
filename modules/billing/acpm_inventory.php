<?php
require("ismodule.php");
require("modules/$modfolder/include_bconfig.php");
include "modules/$modfolder/functions_billing.php";

if ($xrf_myulevel < 4)
{
xrf_go_redir("index.php","Invalid permissions.",2);
}
else
{
	$oldcatid = 0;
	echo "<p align=\"left\" class=\"actions-bar\"><b>Actions:</b> <font size=\"2\"><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addinventory\">[Add Inventory]</a></font></p><p><b>Inventory Management</b></p><table width=100%>";
	
	$query="SELECT * FROM b_inventory ORDER BY catid ASC, id ASC";
	$result=mysqli_query($xrf_db, $query);

	$num=mysqli_num_rows($result);

	$qq=0;
	while ($qq < $num) {

	$id=xrf_mysql_result($result,$qq,"id");
	$descr=xrf_mysql_result($result,$qq,"descr");
	$longdesc=xrf_mysql_result($result,$qq,"longdesc");
	$defamt=xrf_mysql_result($result,$qq,"defamt");
	$catid=xrf_mysql_result($result,$qq,"catid");
	$hidden=xrf_mysql_result($result,$qq,"hidden");
	$is_expense=xrf_mysql_result($result,$qq,"is_expense");
	$apply_salestax=xrf_mysql_result($result,$qq,"apply_salestax");
	$cash = xrfb_disp_cash($defamt);
	if ($hidden == 1) { $opac1 = "<span style=\"opacity:0.5;\">"; $opac2 = "</span>"; $hidd = ", HIDDEN"; }
	else { $opac1 = ""; $opac2 = ""; $hidd = ""; }
	if ($is_expense == 1) { $isexp = ", NOT COUNTED AS INCOME"; }
	else { $isexp = ""; }
	if ($apply_salestax == 1) { $stax = ", SALES TAX APPLIES"; }
	else { $stax = ""; }
	
	if ($oldcatid != $catid) {
		$catname = xrfb_get_category_name($xrf_db, $catid);
		echo "<tr><td align=\"center\" style=\"height:50px; vertical-align:middle;\"><b>$catname</b></td></tr>";
	}

	echo "<tr><td align=\"left\"><details><summary>$opac1$descr - $cash$opac2</summary><p><font size=2>ID: $id$hidd$isexp$stax</font><br>$longdesc</p></details></td></tr>";
	$oldcatid = $catid;
	$qq++;
	}
	
	echo "</table>";

}
?>