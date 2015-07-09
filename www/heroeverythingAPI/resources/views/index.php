<?php
/**
 * Created by PhpStorm.
 * User: hanbz
 * Date: 2015/6/28 0028
 * Time: 下午 06:51
 */
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