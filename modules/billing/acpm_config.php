<?php
require("ismodule.php");
require("modules/$modfolder/include_bconfig.php");

$do = $_GET['do'] ?? '';
if ($do == "change")
{
	$new_print_logo = mysqli_real_escape_string($xrf_db, $_POST['print_logo']);
	$new_inv_line1 = mysqli_real_escape_string($xrf_db, $_POST['inv_line1']);
	$new_inv_line2 = mysqli_real_escape_string($xrf_db, $_POST['inv_line2']);
	$new_inv_line3 = mysqli_real_escape_string($xrf_db, $_POST['inv_line3']);
	$new_inv_line4 = mysqli_real_escape_string($xrf_db, $_POST['inv_line4']);
	$new_inv_line5 = mysqli_real_escape_string($xrf_db, $_POST['inv_line5']);
	$new_inv_line6 = mysqli_real_escape_string($xrf_db, $_POST['inv_line6']);
	$new_tax_rate = mysqli_real_escape_string($xrf_db, $_POST['tax_rate']);
	
	if ($new_print_logo != $xrfb_print_logo)
	{
		$query = "UPDATE b_config SET print_logo = '$new_print_logo'";
		mysqli_query($xrf_db, $query);
		$xrfb_print_logo = $new_print_logo;
		if ($xrf_vlog_enabled == 1)
		{
			$query="INSERT INTO g_log (uid, date, event) VALUES ('$xrf_myid',NOW(),'Changed invoice logo URL.')";
			mysqli_query($xrf_db, $query);
		}
	}
	
	if ($new_inv_line1 != $xrfb_inv_line1 || $new_inv_line2 != $xrfb_inv_line2 || $new_inv_line3 != $xrfb_inv_line3 || $new_inv_line4 != $xrfb_inv_line4 || $new_inv_line5 != $xrfb_inv_line5 || $new_inv_line6 != $xrfb_inv_line6)
	{
		$query = "UPDATE b_config SET inv_line1 = '$new_inv_line1', inv_line2 = '$new_inv_line2', inv_line3 = '$new_inv_line3', inv_line4 = '$new_inv_line4', inv_line5 = '$new_inv_line5', inv_line6 = '$new_inv_line6'";
		mysqli_query($xrf_db, $query);
		$xrfb_inv_line1 = $new_inv_line1; $xrfb_inv_line2 = $new_inv_line2; $xrfb_inv_line3 = $new_inv_line3; $xrfb_inv_line4 = $new_inv_line4; $xrfb_inv_line5 = $new_inv_line5; $xrfb_inv_line6 = $new_inv_line6;
		if ($xrf_vlog_enabled == 1)
		{
			$query="INSERT INTO g_log (uid, date, event) VALUES ('$xrf_myid',NOW(),'Updated invoice lines.')";
			mysqli_query($xrf_db, $query);
		}
	}
	
	if ($new_tax_rate != $xrfb_tax_rate)
	{
		$query = "UPDATE b_config SET tax_rate = '$new_tax_rate'";
		mysqli_query($xrf_db, $query);
		$xrfb_tax_rate = $new_tax_rate;
		if ($xrf_vlog_enabled == 1)
		{
			$query="INSERT INTO g_log (uid, date, event) VALUES ('$xrf_myid',NOW(),'Changed tax rate to $new_tax_rate%.')";
			mysqli_query($xrf_db, $query);
		}
	}
	
	xrf_go_redir("acp.php","Settings changed.",2); 
}
else
{
	echo "
	<p><b>Billing Configuration</b></p>
	<form action=\"acp_module_panel.php?modfolder=$modfolder&modpanel=config&do=change\" method=\"POST\">
	<table><tr><td width=\"350\">
	<table>
		<tr><td>Logo URL:</td><td><input type=\"text\" name=\"print_logo\" value=\"$xrfb_print_logo\" size=\"30\"><br>
		<font size=\"2\">This is the URL of the logo that<br>will print on invoices.<br><i>https://example.com/logo.png</i><p></font></td></tr>
		<tr><td>Invoice Lines:</td><td><input type=\"text\" name=\"inv_line1\" value=\"$xrfb_inv_line1\" size=\"30\"><br>
		<input type=\"text\" name=\"inv_line2\" value=\"$xrfb_inv_line2\" size=\"30\"><br>
		<input type=\"text\" name=\"inv_line3\" value=\"$xrfb_inv_line3\" size=\"30\"><br>
		<input type=\"text\" name=\"inv_line4\" value=\"$xrfb_inv_line4\" size=\"30\"><br>
		<input type=\"text\" name=\"inv_line5\" value=\"$xrfb_inv_line5\" size=\"30\"><br>
		<input type=\"text\" name=\"inv_line6\" value=\"$xrfb_inv_line6\" size=\"30\"><br>
		<font size=\"2\">These lines may be printed on<br>the invoice. Address or contact<br>details may make sense here.<p></font></td></tr>
	</table>
	</td><td width=\"25\"></td><td width=\"350\">
	<table>
		<tr><td></td><td><font size=\"2\"><b>WARNING:</b> Be sure to close<br>invoices out before changing<br>the tax rate to avoid applying<br>retroactively!<p></font></td></tr>
		<tr><td>Tax Rate:</td><td><input type=\"text\" name=\"tax_rate\" value=\"$xrfb_tax_rate\" size=\"30\"><br>
		<font size=\"2\">If your business is taxable, set<br>the percent rate here.<br><i>ex. 7.5</i><p></font></td></tr>
	</table>
	</td></tr></table>
	<input type=\"submit\" value=\"Save Changes\">
	</form>";
}
?>