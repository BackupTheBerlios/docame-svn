CREATE TABLE `mycare_department` (
  `nr` mediumint(9) NOT NULL default '0',
  `target` varchar(30) default '',
  `has_text_result` tinyint(4) default '0',
  `form` varchar(100) default '',
  `order_table` varchar(100) default '',
  `order_sql_select` blob,
  `order_sql_anf` blob,
  `order_sql_insert` blob,
  `batch_nr_init` int(11) NOT NULL default '0',
  `result_table` varchar(100) default '',
  `result_sql` blob,
  PRIMARY KEY  (`nr`)
) TYPE=MyISAM;
