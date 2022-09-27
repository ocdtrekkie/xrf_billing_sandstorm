CREATE TABLE IF NOT EXISTS `b_payments` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `customer` varchar(128) NOT NULL COMMENT 'Email address of customer',
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Date of billing yyyy-mm-dd',
  `oid` int(8) NOT NULL COMMENT 'Order id',
  `amt` int(32) NOT NULL COMMENT 'Amount paid',
  `details` varchar(255) NOT NULL COMMENT 'Payment method and/or transaction ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Individual payments on orders';