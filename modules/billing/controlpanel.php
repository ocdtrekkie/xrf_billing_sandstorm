<?php
require("ismodule.php");

echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=config\">Billing Configuration</a></p>";

echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist&filter=open\">View Open Invoices</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist&filter=closed\">View Closed Invoices</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist\">View All Invoices</a></p>";

echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addorder\">Create New Invoice</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addcharge\">Add New Charge</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addpayment\">Add Payment</a></p>";

?>