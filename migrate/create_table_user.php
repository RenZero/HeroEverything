<?php
include('mysql_connect.php');

$db = Conn();

$sql = "CREATE TABLE IF NOT EXISTS `heroeverything`.`User` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL DEFAULT '',
  `nickname` varchar(11) NOT NULL DEFAULT '',
  `passwd` varchar(32) NOT NULL DEFAULT '',
  `desc` varchar(32) NOT NULL DEFAULT '',
  `orgname` varchar(11) NOT NULL DEFAULT '',
  `bar_list` varchar(50) NOT NULL DEFAULT '',
  `lastlog` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`)
);";

$db->exec($sql);
$db = null;
?>
