<?php
include('mysql_connect.php');

$data = array(
	array(
		'userid' => '2',
		'unit' => '生命',
		'type' => 'hero',
		'name' => 'TEST',
		'title' => 'TEST',
		'vol_current' => '16',
		'vol_max' => '16',
		'cron' => '* * * * * dec 1',
		'api_key' => null,
		'privacy' => null,
	),
	array(
		'userid' => '2',
		'unit' => '$',
		'type' => 'hero',
		'name' => 'TEST',
		'title' => 'TEST',
		'vol_current' => '8',
		'vol_max' => '160',
		'cron' => '* * * * * dec 1',
		'api_key' => null,
		'privacy' => null,
	),
);

$db = Conn();
foreach($data as $val)
{
	$sql = "INSERT INTO `Bar` (`userid`, `unit`, `type`, `name`, `title`, `vol_current`, `vol_max`, `cron`, `api_key`, `privacy`) VALUES
	(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(1, $val['userid']);
	$stmt->bindParam(2, $val['unit']);
	$stmt->bindParam(3, $val['type']);
	$stmt->bindParam(4, $val['name']);
	$stmt->bindParam(5, $val['title']);
	$stmt->bindParam(6, $val['vol_current']);
	$stmt->bindParam(7, $val['vol_max']);
	$stmt->bindParam(8, $val['cron']);
	$stmt->bindParam(9, $val['api_key']);
	$stmt->bindParam(10, $val['privacy']);
	$stmt->execute();	
}
$db = null;
?>
