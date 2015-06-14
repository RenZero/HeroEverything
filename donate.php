<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
    <title>donate大家的夢想</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="application/javascript">
        $(function () {
            $('#donate').click(function () {
                $.ajax({
                    method: "POST",
                    url: "api.php/trigger",
                    data: {barid: "2", action: "inc", vol: "10"}
                })
                    .done(function (msg) {
                        var obj = jQuery.parseJSON(msg)
                        alert("感謝您的捐贈，現在血量為" + obj.vol_current);
                    });
            });
        });
    </script>
</head>
<BODY>
<center>
    <button type="button" id="donate"><img width="150" src="./eco.png"></button>
</center>
</BODY>
</html>