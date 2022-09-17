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
<tr><td><b>Year:</b></td><td><select name=\"taxyear\">
<option value=\"2022\">2022</option>
<option value=\"2021\">2021</option>
<option value=\"2020\">2020</option>
<option value=\"2019\">2019</option>
<option value=\"2018\">2018</option>
<option value=\"2017\">2017</option>
<option value=\"2016\">2016</option>
<option value=\"2015\">2015</option>
<option value=\"2014\">2014</option>
<option value=\"2013\">2013</option>
<option value=\"2012\">2012</option>
<option value=\"2011\">2011</option>
<option value=\"2010\">2010</option>
</select></td></tr>
<tr><td></td><td><input type=\"submit\" value=\"Calculate\"></td></tr></table></form>";

?>