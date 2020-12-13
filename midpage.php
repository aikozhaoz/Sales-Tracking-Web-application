<?php
    print<<<_HTML_
        <html>
        <meta name="google" content="notranslate">
        <meta http-equiv="Content-Language" content="en">
        <head>
            <title>Is hardware included on this purchase order?</title>
        </head>
        <body>
        <h1 style="text-align: center"> Is hardware included on this purchase order? </h1>  

        <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
        <div>
            <input type="button" onclick="document.location.href='Hardware.php';" value="YES" />
            <input type="button" onclick="document.location.href='AppsInfo.php';" value="NO" />
        </div>
        </FORM>
       
    _HTML_;
?>