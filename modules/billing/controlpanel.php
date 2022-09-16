<?php
require("ismodule.php");

echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist&filter=open\">View Open Orders</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist&filter=closed\">View Closed Orders</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=orderlist\">View All Orders</a></p>";

echo "<p><a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addorder\">Create New Order</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addcharge\">Add New Charge</a><br>
<a href=\"acp_module_panel.php?modfolder=$modfolder&modpanel=addpayment\">Add Payment</a></p>";

?>