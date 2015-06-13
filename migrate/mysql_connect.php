<?php
function Conn()
{
	$engine = 'mysql';
	$user = 'paul';
	$pass = '1qaz2wsx';
	$host = 'localhost';
	$db = 'heroeverything';

	try {
		$pdo = new PDO("$engine:host=$host;dbname=$db", $user, $pass);
		$pdo->exec('SET NAMES UTF8');
		return $pdo;
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

}
?>
