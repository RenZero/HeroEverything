<?php
include('mysql_connect.php');

$ip = explode(" ", $_SERVER['SSH_CLIENT']);

$db = Conn();

$sql = "INSERT INTO `User` (`email`, `nickname`, `passwd`, `desc`, `orgname`, `bar_list`, `ip`) VALUES
('test@gmail.com', 'test', 'test', 'this is test', 'HACKATHON', '1,2,3', '$ip[0]');";

$db->exec($sql);
$db = null;
?>
