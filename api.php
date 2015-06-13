<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

//新增血條資料
$app->post('/new/', function () {
	if(!empty($_POST['email']) and !empty($_POST['passwd']) and !empty($_POST['name']) and !empty($_POST['title']) and !empty($_POST['type']) and !empty($_POST['unit']) and !empty($_POST['vol_max']) and !empty($_POST['vol_current']) and !empty($_POST['cron']))
	{
		$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything';
		$user = 'hanbz';
		$password = '1qaz2wsx';

		try {
			$dbh = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}

		$sth = $dbh->prepare('select userid,passwd from User where email =?');
		$sth->execute(array('test@test.test'));
		$result = $sth->fetchAll();
		if($_POST['passwd'] == $result[0]['passwd'])
		{
			$sth = $dbh->prepare('INSERT INTO `Bar` (userid,unit,type,name,title,vol_current,vol_max,cron) VALUES (?,?,?,?,?,?,?,?);');
			$sth->execute(
				array(
					$result[0]['userid'],
					$_POST['unit'],
					$_POST['type'],
					$_POST['name'],
					$_POST['title'],
					$_POST['vol_current'],
					$_POST['vol_max'],
					$_POST['cron']
					)
				);
			echo json_encode(array("status" => "success","message" => "成功新增血條資料"));
		}
	}else
	{
		echo json_encode(array("status" => "fail","message" => "請輸入完整血條資料"));
	}
});

//查詢單筆血條資料
$app->get('/get/:barid', function($barid){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything';
	$user = 'hanbz';
	$password = '1qaz2wsx';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	$sth = $dbh->prepare('select barid,userid,type,unit,name,title,vol_current,vol_max,cron,privacy from Bar where barid =?');
	$sth->execute(array($barid));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if(!empty($result))
	{
		echo json_encode(array(
			'status' => "status" ,
			'barid' => $result['barid'] ,
			'userid' => $result['userid'] ,
			'unit' => $result['unit'] ,
			'type' => $result['type'] ,
			'name' => $result['name'] ,
			'vol_current' => $result['vol_current'] ,
			'vol_max' => $result['vol_max'] ,
			'cron' => $result['cron'] ,
			'privacy' => $result['privacy']
			));
	}
	else
	{
		echo json_encode(array("status" => "error"));
	}
});

//取得使用者全部血條資料
$app->get('/getlist/:barid', function($barid){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything';
	$user = 'hanbz';
	$password = '1qaz2wsx';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	$sth = $dbh->prepare('select barid,userid,type,unit,name,title,vol_current,vol_max,cron,privacy from Bar where barid =?');
	$sth->execute(array($barid));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if(!empty($result))
	{
		echo json_encode(array(
			'status' => "status" ,
			'barid' => $result['barid'] ,
			'userid' => $result['userid'] ,
			'unit' => $result['unit'] ,
			'type' => $result['type'] ,
			'name' => $result['name'] ,
			'vol_current' => $result['vol_current'] ,
			'vol_max' => $result['vol_max'] ,
			'cron' => $result['cron'] ,
			'privacy' => $result['privacy']
			));
	}
	else
	{
		echo json_encode(array("status" => "error"));
	}
});

$app->run();
?>