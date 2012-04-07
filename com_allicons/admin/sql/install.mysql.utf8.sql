DROP TABLE IF EXISTS `#__allicons`;
 
CREATE TABLE IF NOT EXISTS `#__allicons` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`label` varchar(25) NOT NULL DEFAULT '',
	`link` varchar(255) NOT NULL DEFAULT '',
	`icon` varchar(64) NOT NULL DEFAULT '',
	`target` varchar(8) NOT NULL DEFAULT '',
	`description` varchar(255) NOT NULL,
	`published` tinyint(1) NOT NULL DEFAULT '0',
	`catid` int(11) NOT NULL,
	`rtl` tinyint(4) NOT NULL DEFAULT '0',
	`access` tinyint UNSIGNED NOT NULL DEFAULT '0',
	`language` char(7) NOT NULL DEFAULT '',
	`ordering` integer NOT NULL DEFAULT '0',
	`checked_out` integer(10) unsigned NOT NULL default '0',
	`checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',	
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(10) unsigned NOT NULL DEFAULT '0',
	`created_by_alias` varchar(255) NOT NULL DEFAULT '',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(10) unsigned NOT NULL DEFAULT '0',  
	`publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
 
INSERT INTO `#__allicons` (`label`, `link`, `icon`, `description`, `published`, `catid`, `access`) VALUES
	('Clear Cache', 'index.php?option=com_cache', 'icon-48-clear.png', 'Clear the Joomla! cache.', 1, 0, 1);