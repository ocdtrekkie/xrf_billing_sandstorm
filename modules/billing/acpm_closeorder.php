<?php
require("ismodule.php");
$passid = $_GET['passid'];
$id=(int)$passid;

mysqli_query($xrf_db, "UPDATE b_orders SET closed = 1 WHERE id = '$id'") or die(mysqli_error($xrf_db)); 

xrf_go_redir("acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist&filter=open","Invoice closed.",2);
?>