ALTER TABLE `b_inventory`
  ADD `hidden` INT(1) NOT NULL DEFAULT '0' comment
  'If 0, item can be charged. If 1, hide it.' after `catid`,
  ADD `is_expense` INT(1) NOT NULL DEFAULT '0' comment
  'If 0, counts towards net income. If 1, does not add to net income.' after
  `hidden`,
  ADD `apply_salestax` INT(1) NOT NULL DEFAULT '0' comment
  'If 0, do not apply sales tax. If 1, apply sales tax.' after `is_expense`; 