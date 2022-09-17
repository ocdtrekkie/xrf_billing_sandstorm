<?php
require_once("includes/global.php");
require_once("includes/header.php");
require_once("includes/functions_redir.php");

xrf_go_redir("acp_module_panel.php?modfolder=billing&modpanel=orderlist&filter=open","",0);

require_once("includes/footer.php"); ?>