<?php
function Conn()
{
	$engine = 'mysql';
	$user = 'heroeverything';
	$pass = 'we_are_hero';
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
