<?php
session_start();
if(!empty($_POST['user']) and !empty($_POST['pw'])){
$dsn = 'mysql:dbname=heroeverything;host=127.0.0.1';
$user = 'hanbz';
$password = '1qaz2wsx';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
$sth = $dbh->prepare('select passwd from User where email = ?');
	$sth->execute(array($_POST['user']));
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	if(!empty($result['passwd']) and md5($result['passwd']) == $result['passwd']){

	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Everything</title>
</head>
<body>
<form action="" method="post">
Email:
<input type="text" name="email">
Password:
<input type="password" name="pw">
<input type="submit">
</form>
</body>

</html>
