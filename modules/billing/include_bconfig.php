<?php
$xrfb_config_query="SELECT * FROM b_config";
$xrfb_config_result=mysqli_query($xrf_db, $xrfb_config_query);

$xrfb_print_logo=xrf_mysql_result($xrfb_config_result,0,"print_logo");
$xrfb_inv_line1=xrf_mysql_result($xrfb_config_result,0,"inv_line1");
$xrfb_inv_line2=xrf_mysql_result($xrfb_config_result,0,"inv_line2");
$xrfb_inv_line3=xrf_mysql_result($xrfb_config_result,0,"inv_line3");
$xrfb_inv_line4=xrf_mysql_result($xrfb_config_result,0,"inv_line4");
$xrfb_inv_line5=xrf_mysql_result($xrfb_config_result,0,"inv_line5");
$xrfb_inv_line6=xrf_mysql_result($xrfb_config_result,0,"inv_line6");
$xrfb_tax_rate=xrf_mysql_result($xrfb_config_result,0,"tax_rate");
?>