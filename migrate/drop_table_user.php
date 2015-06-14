<?php
include("mysql_connect.php");

$db = Conn();

$sql = "DROP TABLE User";

$db->exec($sql);
$db = null;
?>
