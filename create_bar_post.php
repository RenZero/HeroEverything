<?php
$ip = '10.0.0.188';
$api_new = "http://$ip/api.php/new";

$str = '';
foreach($_POST as $key => $val){
	$str .= $key.'='.$val.'&';
}
$PostData = substr($str, 0, -1);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_new);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POST, 1); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $PostData);

$response = curl_exec($ch);

$status = json_decode($response, true);

if($status['status'] == 'success'){
	header("Location: http://$ip/user.php");
}else{
	header("Location: http://$ip/create_bar.php");
}
curl_close($ch);
?>
