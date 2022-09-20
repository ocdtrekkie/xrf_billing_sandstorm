CREATE TABLE IF NOT EXISTS `b_categories` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Categories for items that can be billed';

CREATE TABLE IF NOT EXISTS `b_charges` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `customer` varchar(128) NOT NULL COMMENT 'Email address of customer',
  `oid` int(8) NOT NULL COMMENT 'Order id',
  `iid` int(8) NOT NULL COMMENT 'Item id',
  `amt` int(32) NOT NULL COMMENT 'Amount for this item',
  `quantity` int(8) NOT NULL DEFAULT '1' COMMENT 'Quantity of items at cost listed',
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'W = Waived',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Individual charges on orders';

CREATE TABLE IF NOT EXISTS `b_config` (
  `print_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line1` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line2` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line3` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line4` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line5` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `inv_line6` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `tax_rate` float NOT NULL DEFAULT '0' COMMENT 'Rate of tax to be applied to orders',
  PRIMARY KEY (`print_logo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Billing module configuration table';

INSERT INTO `b_config` (`print_logo`, `inv_line1`, `inv_line2`, `inv_line3`, `inv_line4`, `inv_line5`, `inv_line6`, `tax_rate`) VALUES ('', '', '', '', '', '', '', '0');

CREATE TABLE IF NOT EXISTS `b_inventory` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `descr` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `longdesc` text COLLATE utf8_unicode_ci NOT NULL,
  `defamt` int(32) NOT NULL COMMENT 'Default amount of item',
  `catid` int(4) NOT NULL COMMENT 'Item category id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Items that can be billed';

CREATE TABLE IF NOT EXISTS `b_orders` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `customer` varchar(128) NOT NULL COMMENT 'Email address of customer',
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Date of billing yyyy-mm-dd hh:mm:ss',
  `aid` int(8) NOT NULL DEFAULT '1' COMMENT 'User ID of Associate',
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `amt_taxes` int(32) NOT NULL DEFAULT '0',
  `amt_due` int(32) NOT NULL DEFAULT '0',
  `amt_paid` int(32) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0' COMMENT 'If 0, order is open.  If 1, order is closed.',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT IGNORE INTO g_modules (`name`,`prefix`,`folder`,`ord`,`active`) VALUES('Billing','b','billing',1,1);
INSERT IGNORE INTO g_modules (`name`,`prefix`,`folder`,`ord`,`active`) VALUES('Taxes','tx','taxes',2,1);