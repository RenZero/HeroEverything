<?php
include("migrate/mysql_connect.php");
session_start();

$ip = '10.0.0.188';
if(!empty($_POST['email']) and !empty($_POST['pw'])){

$dbh = Conn();
$sth = $dbh->prepare('select userid, passwd from User where email = ?');
	$sth->execute(array($_POST['email']));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	$count = $sth->rowCount();
	if($count > 0){
		if(!empty($result['passwd']) and md5($_POST['pw']) == $result['passwd']){
			$_SESSION['userid'] = $result['userid'];
			header("Location: http://$ip/user.php");
		}else{
			header("Location: http://$ip/index.php");
			//header('Location: http://10.0.0.79/index.php');
		}
	}else{
		$sql = "insert into User (`email`, `nickname`, `passwd`, `desc`, `orgname`, `bar_list`, `lastlog`, `ip`) values (?, 'test', ?, 'test', 'test', null, null, '127.0.0.1')";
		$sth = $dbh->prepare($sql);
		$sth->execute(array($_POST['email'], md5($_POST['pw'])));
		$userid = $dbh->lastInsertId();

		$_SESSION['userid'] = $userid;
		header("Location: http://$ip/user.php");
		//header('Location: http://10.0.0.188/user.php');
	}
$dbh = null;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Hero To Everything</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/style.css">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<form action="" method="post">
<div class="form-group">
Email:
<input type="text" name="email">
</div>
<div class="form-group">
Password:
<input type="password" name="pw">
</div>
<div class="form-group">
<input type="submit" value="登入">
</div>
</form>
</div>
</body>

</html>
