<?php
include('mysql_connect.php');

//$ip = explode(" ", $_SERVER['SSH_CLIENT']);
$ip = "127.0.0.1";

$db = Conn();

$sql = "INSERT INTO `User` (`email`, `nickname`, `passwd`, `desc`, `orgname`, `bar_list`, `ip`) VALUES
('test@gmail.com', 'test', '".md5('test')."', 'this is test', 'HACKATHON', '1,2,3', '$ip');";

$db->exec($sql);
$db = null;
?>
