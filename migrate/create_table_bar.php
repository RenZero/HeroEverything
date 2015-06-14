<?php
include('mysql_connect.php');

$db = Conn();

$sql = "CREATE TABLE IF NOT EXISTS `heroeverything`.`Bar` (
  `barid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `unit` varchar(11) NOT NULL DEFAULT '',
  `type` varchar(11) NOT NULL DEFAULT '',
  `name` varchar(11) NOT NULL DEFAULT '',
  `title` varchar(20) NOT NULL DEFAULT '',
  `vol_current` int(11) unsigned NOT NULL,
  `vol_max` int(11) unsigned NOT NULL,
  `cron` varchar(30) NOT NULL DEFAULT '',
  `api_key` varchar(20) DEFAULT NULL,
  `privacy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`barid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;";

$db->exec($sql);
$db = null;
?>
