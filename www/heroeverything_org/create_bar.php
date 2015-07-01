<?php
session_start();
$ip = 'heroeverything.com';
if(!isset($_SESSION['userid'])){
	header("Location: http://$ip/index.php");
}

$userid = $_SESSION['userid'];

include("migrate/mysql_connect.php");
$dbh = Conn();
$sql = "select email, passwd from User where userid=?";
$sth = $dbh->prepare($sql);
$sth->execute(array($userid));
while($result = $sth->fetch(PDO::FETCH_ASSOC)){
        $email = $result['email'];
        $passwd = $result['passwd'];
}
$dbh = null;
?>
<!DOCTYPE html>
<html>
<head>
<title>Everything</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./bootstrap/css/style.css">
<script type="text/javascript" src="./bootstrap/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
$(function() {
	$('#back').click(function(){
		window.location.href = '<?php echo "http://$ip/user.php"; ?>';
	});
});
</script>
</head>
<body>
	<div class="container">
		<div class="text-center">
			<h1>把看到的東西都加上血條</h1>
		</div>
		<form id="form" action="create_bar_post.php" method="post" class="form-horizontal">
                        <div class="form-group">
                                <label class="col-sm-2 control-label">血條名稱:</label>
				<div class="col-sm-10">
	                                <input type="text" name="name" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">職業:</label>
				<div class="col-sm-10">
                                	<input type="text" name="title" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">現在血量:</label>
				<div class="col-sm-10">
                                	<input type="text" name="vol_current" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">最大血量:</label>
				<div class="col-sm-10">
                                	<input type="text" name="vol_max" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">單位:</label>
				<div class="col-sm-10">
                                	<input type="text" name="unit" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">類型:</label>
				<div class="col-sm-10">
                                	<select name="type" class="form-control">
						<option value="hero">hero</option>
					</select>
				</div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label">排程規則:</label>
				<div class="col-sm-10">
           	                	<input type="text" name="cron" class="form-control">
				</div>
                        </div>
                        <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
           	                	<input type="hidden" name="email" value="<?php echo $email; ?>">
           	                	<input type="hidden" name="passwd" value="<?php echo $passwd; ?>">
	                                <input type="submit" class="btn btn-primary" value="新增">
	                                <input type="button" class="btn btn-default" id="back" value="返回">
				</div>
                        </div>
                </form>
	</div>
</body>
</html>
