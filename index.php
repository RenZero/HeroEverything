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
            echo "<script>alert(\"輸入密碼錯誤，請重新輸入\");location.href = 'http://10.0.0.188/index.php';</script>";
			//header("Location: http://$ip/index.php");
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
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./bootstrap/css/style.css">
</head>
<body>
	<div class="container">
	<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="top: 200px;">
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label>Email:</label>
				<input type="text" name="email" class="form-control" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
				<input type="password" name="pw" class="form-control" required>
			</div>
			<div class="form-group">
				<input class="btn btn-primary" type="submit" value="登入">
			</div>
		</form>
		</div>
		<div class="col-md-4"></div>
	 </div>
	</div>
</body>

</html>
