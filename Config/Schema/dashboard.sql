--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Name of the variable',
  `value` text character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Value of the variable',
  `description` varchar(255) character set utf8 collate utf8_unicode_ci default NULL COMMENT 'Description of the variable',
  `type` varchar(255) character set utf8 collate utf8_unicode_ci default NULL COMMENT 'Type of the variable',
  `display_title` varchar(255) character set utf8 collate utf8_unicode_ci default NULL COMMENT 'Variable display title',
  `display_order` int(11) NOT NULL default '0' COMMENT 'Variable order placement',
  PRIMARY KEY  (`id`)
); 


