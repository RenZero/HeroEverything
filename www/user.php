<?php
session_start();
$ip = '10.0.0.188';
if(!isset($_SESSION['userid'])){
	header("Location: http://$ip/index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Everything</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/style.css">

	<!-- jsProgressBarHandler prerequisites : prototype.js -->
	<script type="text/javascript" src="js/prototype/prototype.js"></script>

	<!-- jsProgressBarHandler core -->
	<script type="text/javascript" src="js/bramus/jsProgressBarHandler.js"></script>

<script type="text/javascript" src="./bootstrap/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(function() {
	$(':button[name="del"]').click(function(){
		$.ajax({
			url: '<?php echo "http://$ip/api.php/del"; ?>',
			data: $(this).parent("form").serialize(),
			type:"POST",
			dataType:'text',

			success: function(msg){
				//alert(msg);
			},

			error:function(xhr, ajaxOptions, thrownError){ 
				alert(xhr.status); 
				alert(thrownError); 
			}
		});
	});
	$(':button[name="trigger"]').click(function(){
		$.ajax({
			url: '<?php echo "http://$ip/api.php/trigger"; ?>',
			data: $(this).parent("form").serialize(),
			type:"POST",
			dataType:'text',

			success: function(msg){
				//alert(msg);
				window.location.href = '<?php echo "http://$ip/user.php"; ?>';
			},

			error:function(xhr, ajaxOptions, thrownError){ 
				alert(xhr.status); 
				alert(thrownError); 
			}
		});
	});
});
</script>
</head>
<body>
	<div class="container">
	
<?php
include("migrate/mysql_connect.php");
$user_id = $_SESSION['userid'];

$dbh = Conn();
$sql = "select nickname, email, passwd from User where userid=?";
$sth = $dbh->prepare($sql);
$sth->execute(array($user_id));
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
	$user_name = $result['nickname'];
	$email = $result['email'];
	$passwd = $result['passwd'];
}
$data = `curl -XPOST "http://$ip/api.php/getlist" -d "email=$email&passwd=$passwd"`;
$data = json_decode($data, true);
//print_r($data);
?>
<h2> <?php echo $user_name; ?>'s List </h2>
<a href="create_bar.php" class="btn btn-success">新增血條</a>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>血條名稱</th>
<th>現況</th>
<th>最大</th>
<th>單位</th>
<th>類型</th>
<th>職業</th>
<th></th>
</thead>
<tbody>
<?php
if(count($data) > 0){
	foreach($data as $val){
		$barid = $val['barid'];
		$json = `curl -XGET http://$ip/api.php/get/$barid`;
		$bar_data = json_decode($json, true);
		
		echo '<tr>';
		echo '<td><a href="blood.php?model=2" target="_blank">'.$bar_data['name'].'</a></td>';
		echo '<td>'.$bar_data['vol_current'].'</td>'; 
		echo '<td>'.$bar_data['vol_max'].'</td>'; 
		echo '<td>'.$bar_data['unit'].'</td>'; 
		echo '<td>'.$bar_data['type'].'</td>'; 
		echo '<td>'.$bar_data['title'].'</td>'; 
		//echo '<td class="col-xs-6">血條</td>'; 
		echo '<td>';
		echo '<form action="" method="POST" style="display:inline;">';
		echo '<input type="button" name="trigger" class="btn btn-default" value="+">&nbsp;';
		echo '<input type="hidden" name="barid" value="'.$barid.'">';
		echo '<input type="hidden" name="action" value="inc">';
		echo '<input type="hidden" name="vol" value="5">';
		echo '</form>';
		echo '<form action="" method="POST" style="display:inline;">';
		echo '<input type="button" name="trigger" class="btn btn-default" value="-">&nbsp;';
		echo '<input type="hidden" name="barid" value="'.$barid.'">';
		echo '<input type="hidden" name="action" value="dec">';
		echo '<input type="hidden" name="vol" value="5">';
		echo '</form>';
		//echo '<a href="" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;';
		echo '<form action="" method="POST" style="display:inline;">';
		echo '<button name="del" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
		echo '<input type="hidden" name="barid" value="'.$barid.'">';
		echo '</form>';
		echo '</td>'; 
		echo '</tr>';

		//echo '<tr>';
        	//echo '<td colspan="7">';
       	 	//echo '<span class="progressBar" id="element1">23%_2</span>';
        	//echo '</td>';
        	//echo '</tr>';
	}
}


$dbh = null;
?>
</tbody>
</table>
</div>
</body>
</html>
