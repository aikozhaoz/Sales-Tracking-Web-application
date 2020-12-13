<?php
    print<<<_HTML_
        <html>
        <meta name="google" content="notranslate">
        <meta http-equiv="Content-Language" content="en">
        <head>
            <title> Thank you for using COVID Tech. system! </title>
        </head>
        <body>
        <h1 style="text-align: center"> Thank you for using COVID Tech. system! </h1>  
        <h2 style="text-align: center"> Bye! </h2>  

        <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
        <div>
            <input type="button" onclick="document.location.href='index.php';" value="Restart the program" />
        </div>
        </FORM>
       
    _HTML_;
?>