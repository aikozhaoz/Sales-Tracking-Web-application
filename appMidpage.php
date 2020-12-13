<?php
    print<<<_HTML_
        <html>
        <meta name="google" content="notranslate">
        <meta http-equiv="Content-Language" content="en">
        <head>
            <title>Please enter the applications purchased one at a time.</title>
        </head>
        <body>
        <h1 style="text-align: center"> Please enter the applications purchased one at a time.</h1>  

        <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
        <div>
            <input type="button" onclick="document.location.href='AppsInfo.php';" value="YES" />
        </div>
        </FORM>
       
    _HTML_;
?>