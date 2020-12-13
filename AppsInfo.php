<?php
    require "DatabaseConnect.php";
    session_start();

    print<<<_HTML_
    <html>
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <head>
        <title>3241 Project Autumn 2020</title>
    </head>
    <body>
    <h1 style="text-align: center"> Applications Info </h1>  

    <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
       <div>
            Application Name: <input type="text" name="appName" required>
       </div>
       <div>
            Application release : <input type="text" name="Rel" required>
       </div>
       <div>
       Purchase date: <input type="text" name="purDate" required>
       </div>
       <div>
            Application support contract end date: <input type="text" name="Support">
       </div>

       <input type="submit" name="SubmitButton" method="POST" value = "SUBMIT"/>
    </FORM>
    _HTML_;

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //mysqli_begin_transaction($conn);
        $find_appID_sql = "SELECT appID from APP WHERE appName = ? AND Rel = ?";
        if($selectappID = mysqli_prepare($conn, $find_appID_sql)){
            mysqli_stmt_bind_param($selectappID,"sd",$_POST['appName'], $_POST['Rel']);
            mysqli_stmt_execute($selectappID);
            mysqli_stmt_bind_result($selectappID, $appID);
            mysqli_stmt_fetch($selectappID);
            mysqli_stmt_close($selectappID); 
            $_SESSION['appID']  = $appID;

            if(empty($appID)){
                exit("Application information cannot be found in HARDWARE.");
            }else{
                $find_insertappID_sql = "INSERT INTO CUSAPP VALUES( ?, ?, ?, ?)";
                $cusID = $_SESSION['cusID'];
                if($insertAppID = mysqli_prepare($conn, $find_insertappID_sql)){              
                    mysqli_stmt_bind_param($insertAppID,"dsss", $cusID,$appID, $_POST['purDate'], $_POST['Support']);
                    mysqli_stmt_execute($insertAppID);
                    mysqli_stmt_close($insertAppID);                 
                }
                echo "<script type='text/javascript'> document.location ='ContinueApp.php'</script>";
            }

        }    
    }
    mysqli_close($conn);
    exit();

?>