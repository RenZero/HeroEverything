<?php
session_cache_limiter(false);
session_start();
require 'vendor/autoload.php';

$app = new \Slim\Slim();


//新增血條資料
$app->post('/new/', function () {
	if(!empty($_POST['email']) and !empty($_POST['passwd']) and !empty($_POST['name']) and !empty($_POST['title']) and !empty($_POST['type']) and !empty($_POST['unit']) and !empty($_POST['vol_max']) and !empty($_POST['vol_current']) and !empty($_POST['cron']))
	{
		$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything;charset=utf8';
		$user = 'xxxx';
		$password = '1qaz2wsx';

		try {
			$dbh = new PDO($dsn, $user, $password);
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}

		$sth = $dbh->prepare('select userid,passwd from User where email =?');
		$sth->execute(array($_POST['email']));
		$result = $sth->fetchAll();
		if($_POST['passwd'] == $result[0]['passwd']) {
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
            echo json_encode(array("status" => "success", "message" => "成功新增血條資料"));
        }else
        {
            echo json_encode(array("status" => "fail", "message" => "帳號密碼錯誤"));
            exit;
        }
	}else
	{
		echo json_encode(array("status" => "fail","message" => "請輸入完整血條資料"));
	}
});

//查詢單筆血條資料
$app->get('/get/:barid', function($barid){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything;charset=utf8';
	$user = 'xxxxx';
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
			'title' => $result['title'] ,
			'vol_current' => (int)$result['vol_current'] ,
			'vol_max' => (int)$result['vol_max'] ,
			'cron' => $result['cron'] ,
			'privacy' => $result['privacy']
			),JSON_UNESCAPED_UNICODE);
	}
	else
	{
		echo json_encode(array("status" => "error"),JSON_UNESCAPED_UNICODE);
	}
});

//取得使用者全部血條資料
$app->post('/getlist/', function(){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything;charset=utf8';
	$user = 'xxxxx';
	$password = '1qaz2wsx';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	if(isset($_SESSION['userid'])){
		$sth = $dbh->prepare('select barid,userid,type,unit,name,vol_current,vol_max,cron,privacy from Bar where userid =?');
		$sth->execute(array($_SESSION['userid']));
		$result = $sth->fetchAll();
		foreach ($result as $index => $value) {
			$result_array[$index]['barid'] =  $value['barid'];
			$result_array[$index]['userid'] =  $value['userid'];
			$result_array[$index]['unit'] =  $value['unit'];
			$result_array[$index]['type'] =  $value['type'];
			$result_array[$index]['name'] =  $value['name'];
			$result_array[$index]['vol_current'] =  $value['vol_current'];
			$result_array[$index]['vol_max'] =  $value['vol_max'];
			$result_array[$index]['cron'] =  $value['cron'];
			$result_array[$index]['privacy'] =  $value['privacy'];
		}
		if(!empty($result))
		{
			echo json_encode($result_array,JSON_UNESCAPED_UNICODE);
		}
		else
		{
			echo json_encode(array("status" => "error"),JSON_UNESCAPED_UNICODE);
		}
	}
	elseif (!empty($_POST['email']) and !empty($_POST['passwd'])) {
		$sth = $dbh->prepare('select userid,passwd from User where email = ?');
		$sth->execute(array($_POST['email']));
		$result = $sth->fetch(PDO::FETCH_ASSOC);
		if($result['passwd'] == $_POST['passwd'])
		{
			$sth = $dbh->prepare('select barid from Bar where userid =?');
			$sth->execute(array($result['userid']));
			$result1 = $sth->fetchAll();
			foreach ($result1 as $index => $value) {
				$result_array[$index]['barid'] =  $value['barid'];
			}
			if(!empty($result))
			{
				echo json_encode($result_array,JSON_UNESCAPED_UNICODE);
			}
			else
			{
				echo json_encode(array("status" => "error"),JSON_UNESCAPED_UNICODE);
			}
		}
	}
});

//刪除血條
$app->post('/del/', function(){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything;charset=utf8';
	$user = 'xxxxx';
	$password = '1qaz2wsx';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	if(!empty($_POST['barid'])){
	$sth = $dbh->prepare('DELETE FROM Bar WHERE barid=?');
	$sth->execute(array($_POST['barid']));
	echo json_encode(array("status" => "success"),JSON_UNESCAPED_UNICODE);
	}
});

//觸發血條動作
$app->post('/trigger/', function(){
	$dsn = 'mysql:host=127.0.0.1;dbname=heroeverything;charset=utf8';
	$user = 'xxxxx';
	$password = '1qaz2wsx';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	if(isset($_POST['barid']) and isset($_POST['action']) and isset($_POST['vol'])){
		if($_POST['action']=='inc'){
			$value = $_POST['vol'];
		}elseif ($_POST['action']=='dec') {
			$value = (0-$_POST['vol']);
		}
		$sth = $dbh->prepare('UPDATE `Bar` SET `vol_current`=`vol_current`+? WHERE `barid`=?;');
		$sth->execute(array($value,$_POST['barid']));

		$sth1 = $dbh->prepare('select vol_current,vol_max from Bar where barid = ?');
		$sth1->execute(array($_POST['barid']));

		$result = $sth1->fetch(PDO::FETCH_ASSOC);
		echo json_encode(array("status" => "success","vol_current" => $result['vol_current'],"vol_max" =>$result['vol_max']),JSON_UNESCAPED_UNICODE);
	}

});

$app->run();
?>