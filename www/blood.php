<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
    <title>jsProgressBarHandler Demo | Javascript Progress/Percentage Bar</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- jsProgressBarHandler prerequisites : prototype.js -->
    <script type="text/javascript" src="js/prototype/prototype.js"></script>

    <!-- jsProgressBarHandler core -->
    <script type="text/javascript" src="js/bramus/jsProgressBarHandler.js"></script>

    <script>
        var int=self.setInterval("makeRequest('http://10.0.0.188/api.php/get/2')",1000);

        function makeRequest(url) {
            /*myJsProgressBarHandler.setPercentage('element1','50');*/
            var httpRequest;

            if (window.XMLHttpRequest) { // Mozilla, Safari, ...
                httpRequest = new XMLHttpRequest();
                if (httpRequest.overrideMimeType) {
                    httpRequest.overrideMimeType('text/xml');
                }
            }
            else if (window.ActiveXObject) { // IE
                try {
                    httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e) {
                    }
                }
            }

            if (!httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = function () {
                alertContents(httpRequest);
            };
            httpRequest.open('GET', url, true);
            httpRequest.send('');
        }

        function alertContents(httpRequest) {

            if (httpRequest.readyState == 4) {
                if (httpRequest.status == 200) {
                    /*alert(httpRequest.responseText);*/
                    var obj = JSON.parse(httpRequest.responseText);
                    myJsProgressBarHandler.setPercentage('element1',Math.round((obj.vol_current/obj.vol_max)*100));
                } else {
                    alert('There was a problem with the request.');
                }
            }
        }
    </script>

    <style type="text/css">

        /* General Links */
        a:link {
            text-decoration: none;
            color: #3366cc;
            border: 0px;
        }

        a:active {
            text-decoration: underline;
            color: #3366cc;
            border: 0px;
        }

        a:visited {
            text-decoration: none;
            color: #3366cc;
            border: 0px;
        }

        a:hover {
            text-decoration: underline;
            color: #ff5a00;
            border: 0px;
        }

        img {
            padding: 0px;
            margin: 0px;
            border: none;
        }

        body {
            margin: 0 auto;
            width: 100%;
            font-family: 'Verdana';
            color: #FFFFFF;
            background: #000000;
            font-size: 12px;
            text-align: center;
        }

        .content {
            margin: 20px;
            line-height: 20px;
        }

        body h1 {
            font-size: 14px;
            font-weight: bold;
            color: #CC0000;
            padding: 5px;
            border-bottom: solid;
            border-bottom-width: 1px;
            border-bottom-color: #333333;
        }

        body h2 {
            font-size: 14px;
            font-weight: bold;
            color: #CC0000;
            padding: 5px;
            border-bottom: solid;
            border-bottom-width: 1px;
            border-bottom-color: #333333;
        }

        #demo {
            margin: 0 auto;
            width: 100%;
        }

        #demo .extra {
            padding-left: 30px;
        }

        #demo .options {
            padding-left: 10px;
        }

        #demo .getOption {
            padding-left: 10px;
            padding-right: 20px;
        }
    </style>

</head>

<?php
$barid = '2';

$json_string = `curl -XGET http://10.0.0.188/api.php/get/$barid`;
$parsed_json = json_decode($json_string);
$name = $parsed_json->{'name'};
$vol_current = $parsed_json->{'vol_current'};
$vol_max = $parsed_json->{'vol_max'};
echo "$name \n $vol_current \n$vol_max\n\n";
?>

<body>

<div style="width:540px;margin : 0 auto; text-align:left;">


    <div id="demo">

        <h2>血條</h2>
        <span style="color:#006600;font-weight:bold;"><?php echo $name ?></span> <br/>
        <span class="progressBar" id="element1"><?php echo round($vol_current / $vol_max * 100) ?>%_2</span><br/>

        <span class="extra"><a href="#"
                               onclick="myJsProgressBarHandler.setPercentage('element1','0');return false;"><img
                    src="images/icons/empty.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Empty Bar'"/></a></span>
        <span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element1','+1');return false;"><img
                    src="images/icons/add.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Add 1%'"/></a></span>
        <span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element1','-5');return false;"><img
                    src="images/icons/minus.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Minus 5%'"/></a></span>
        <span class="options"><a href="#" onclick="myJsProgressBarHandler.setPercentage('element1','15');return false;"><img
                    src="images/icons/set.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Set 15%'"/></a></span>
        <span class="options"><a href="#"
                                 onclick="myJsProgressBarHandler.setPercentage('element1','100');return false;"><img
                    src="images/icons/fill.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Fill 100%'"/></a></span>
        <span class="getOption"><a href="#"
                                   onclick="alert(myJsProgressBarHandler.getPercentage('element1'));return false;"><img
                    src="images/icons/get.gif" alt="" title=""
                    onmouseout="$('Text1').innerHTML ='&laquo; Select Options'"
                    onmouseover="$('Text1').innerHTML ='Get Current %'"/></a></span>
        <span id="Text1" style="font-weight:bold">&laquo; Select Options</span>
        <br/><br/>

    </div>

</div>
<!-- STATS -->
<!--	<script src="/mint/?js" type="text/javascript"></script>-->

<!--	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>-->
<!--	<script type="text/javascript">-->
<!--		// <![CDATA[-->
<!--		_uacct = "UA-107008-4";-->
<!--		urchinTracker();-->
<!--		// ]]>-->
<!--	</script>-->

</body>
</html>
