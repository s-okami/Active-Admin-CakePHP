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

--
-- Table structure for table `admin_comments`
--
CREATE TABLE `admin_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(30) NOT NULL,
  `foreign_id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class` (`class`),
  KEY `author` (`author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

