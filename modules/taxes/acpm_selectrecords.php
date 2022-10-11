<?php
require("ismodule.php");
echo "<b>Calculate Tax Records</b><p>";

$query="SELECT * FROM g_users WHERE ulevel > 2";
$result=mysqli_query($xrf_db, $query);
$num=mysqli_num_rows($result);

echo "<form action=\"acp_module_panel.php?modfolder=taxes&modpanel=viewrecords\" method=\"POST\">
<table>
<tr><td><b>Associate:</b></td><td><select name=\"taxassoc\">";
$qq=0;
while ($qq < $num) {
$c_id=xrf_mysql_result($result,$qq,"id");
$c_username=xrf_mysql_result($result,$qq,"username");

if ($c_id == $xrf_myid) $pickme = " selected";
	else $pickme = "";

echo "<option value='$c_id'$pickme>$c_username</option>";

$qq++;
}

echo "</select></td></tr>
<tr><td><b>Year:</b></td><td><select name=\"taxyear\">";

$yquery="SELECT date FROM b_orders ORDER BY date ASC LIMIT 1";
$yresult=mysqli_query($xrf_db, $yquery);
$startyear=substr(xrf_mysql_result($yresult,0,"date"),0,4);
$qy=date("Y");
while ($qy >= $startyear) {
	echo "<option value=\"$qy\">$qy</option>";
	$qy--;
}

echo "</select></td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Calculate\"></td></tr></table></form>";

?>