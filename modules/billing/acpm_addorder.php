<?php
require("ismodule.php");
$do = $_GET['do'] ?? '';
if ($do == "add")
{
$customer = mysqli_real_escape_string($xrf_db, $_POST['customer']);
$date = mysqli_real_escape_string($xrf_db, $_POST['date']);
$notes = mysqli_real_escape_string($xrf_db, $_POST['notes']);
$aid = $_POST['assoc'];
$aid = (int)$aid;

mysqli_query($xrf_db, "INSERT INTO b_orders (customer, date, aid, notes) VALUES('$customer', '$date', '$aid', '$notes')") or die(mysqli_error($xrf_db));
$oid = mysqli_insert_id($xrf_db);

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=vieworder&id=$oid","Order created.",2);
}
else
{
echo "<b>Create New Invoice</b><p>";
$currentdate = date("Y-m-d");
echo "<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addorder&do=add\" method=\"POST\">
<table><tr><td><b>Customer Name:</b></td><td><input type=\"text\" name=\"customer\" size=\"50\" required> <input type=\"submit\" value=\"Create\"></td></tr>
<tr><td><b>Date of Invoice:</b></td><td><input type=\"date\" name=\"date\" id=\"datePicker\" value=\"$currentdate\" required></td></tr>
<tr><td><b>Notes:</b></td><td><textarea name=\"notes\" rows=\"8\" cols=\"50\"></textarea></td></tr>
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

echo "<script>document.addEventListener(\"DOMContentLoaded\", function(event){
var d = new Date(); 
var today = d.getFullYear()+\"-\"+(\"0\"+(d.getMonth()+1)).slice(-2)+\"-\"+(\"0\"+d.getDate()).slice(-2);
document.getElementById(\"datePicker\").value = today;
});</script>"; // https://stackoverflow.com/a/63663084
}
?>