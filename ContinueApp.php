<?php
    print<<<_HTML_
        <html>
        <meta name="google" content="notranslate">
        <meta http-equiv="Content-Language" content="en">
        <head>
            <title>Do you want to continue adding applications?</title>
        </head>
        <body>
        <h1 style="text-align: center"> Do you want to continue adding applications? </h1>  

        <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
        
        <div>
            <input type="button" onclick="document.location.href='AppsInfo.php';" value="YES" />
            <input type="button" onclick="document.location.href='bye.php';" value="NO" />
        </div>
        
        </FORM>
       
    _HTML_;
?>