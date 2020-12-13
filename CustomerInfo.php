<?php
    require "DatabaseConnect.php";
 
    print<<<_HTML_
    <html>
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <head>
        <title>3241 Project Autumn 2020</title>
    </head>
    <body>
    <h1 style="text-align: center"> COVID Tech. Order Form </h1>  

    <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
    <div>
        Enter Customer Name here: <input type="text" name="cusName" required>
    </div>
    <div>
        Enter Contact Person here: <input type="text" name="contactName" required>
    </div>
    <div>
        Enter Contact Phone Number Name here: <input type="text" name="contactNo" required>
    </div>
    <input type="submit" name="SubmitButton" method="POST" value = "SUBMIT"/>
    </FORM>
    _HTML_;
    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['cusName'])){
        // mysqli_begin_transaction($conn);
        $find_cusID_sql = "SELECT cusID from CUSTOMER WHERE cusName = ?";
        if($selectcusID = mysqli_prepare($conn, $find_cusID_sql)){         
            mysqli_stmt_bind_param($selectcusID,"s",$_POST['cusName']);
            mysqli_stmt_execute($selectcusID);
            mysqli_stmt_bind_result($selectcusID, $cusID);
            mysqli_stmt_fetch($selectcusID);
            mysqli_stmt_close($selectcusID); 
            $_SESSION['newUserOrNot']  = False;
            if(empty($cusID)){
                $find_maxcusID_sql = "SELECT MAX(cusID) from CUSTOMER";
                if($selectmaxcusID = mysqli_prepare($conn, $find_maxcusID_sql)){
                    mysqli_stmt_execute($selectmaxcusID);
                    mysqli_stmt_bind_result($selectmaxcusID, $maxcusID);
                    mysqli_stmt_fetch($selectmaxcusID);
                    mysqli_stmt_close($selectmaxcusID); 
                    $cusID = $maxcusID + 1;

                    $find_insertNewcusID_sql = "INSERT INTO CUSTOMER VALUES(?, ?, ?, ?)";
                    if($insertNewcusID = mysqli_prepare($conn, $find_insertNewcusID_sql)){
                        mysqli_stmt_bind_param($insertNewcusID,"dssi",$cusID, $_POST['cusName'], $_POST['contactName'], $_POST['contactNo']);
                        mysqli_stmt_execute($insertNewcusID);
                        mysqli_stmt_close($insertNewcusID);                 
                    }
                }
                $_SESSION['newUserOrNot'] = True;
            }
            $_SESSION['cusID'] = $cusID;  

            echo "<script type='text/javascript'> document.location ='midpage.php'</script>";
        }    
    }
    mysqli_close($conn);
    exit();
?>