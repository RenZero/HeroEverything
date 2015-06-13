<?php
include("mysql_connect.php");

$db = Conn();

$sql = "DROP TABLE Bar";

$db->exec($sql);
$db = null;
?>
