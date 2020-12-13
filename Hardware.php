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
     <h1 style="text-align: center"> Hardware Info </h1>  
 
     <FORM style="text-align:center" method="POST" action="$_SERVER[PHP_SELF]">
        <div>
            Server manufacturer: <input type="text" name="manufacturer" required>
        </div>
        <div>
            Model: <input type="text" name="model" required>
        </div>
        <div>
            OS(Operating System): <input type="text" name="OS" required>
        </div>
        <div>
            Purchase date: <input type="text" name="purDate" required>
        </div>

        <div>
            Support contract end date: <input type="text" name="Support">
        </div>
        <div>
            Web server: <input type="text" name="Web">
        </div>
        <div>
            Java version : <input type="text" name="Java">
        </div>
        <div>
            PHP version  : <input type="text" name="PHP">
        </div>

        <input type="submit" name="SubmitButton" method="POST" value = "SUBMIT"/>
     </FORM>
     _HTML_;
     
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        //mysqli_begin_transaction($conn);
        $find_machineID_sql = "SELECT machineID from HARDWARE WHERE manufacturer = ? AND model = ?";
        if($selectmachineID = mysqli_prepare($conn, $find_machineID_sql)){
            mysqli_stmt_bind_param($selectmachineID,"ss",$_POST['manufacturer'], $_POST['model']);
            mysqli_stmt_execute($selectmachineID);
            mysqli_stmt_bind_result($selectmachineID, $machineID);
            mysqli_stmt_fetch($selectmachineID);
            mysqli_stmt_close($selectmachineID); 
            if(empty($machineID)){
                exit("Machine information cannot be found in HARDWARE.");
            }
            else{
                $sysNo = 1;
                if(!$_SESSION['newUserOrNot']){
                    $cusID = $_SESSION['cusID'];
                    $find_maxsysNo_sql = "SELECT MAX(sysNo) from CUSENV where cusID = $cusID";
                    if($selectmaxsysNo = mysqli_prepare($conn, $find_maxsysNo_sql)){
                        mysqli_stmt_execute($selectmaxsysNo);
                        mysqli_stmt_bind_result($selectmaxsysNo, $maxsysNo);
                        mysqli_stmt_fetch($selectmaxsysNo);
                        mysqli_stmt_close($selectmaxsysNo); 
                        $sysNo = $maxsysNo + 1;
                    }
                }
                
                $find_insertMachineID_sql = "INSERT INTO CUSENV VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                if($insertMachineID = mysqli_prepare($conn, $find_insertMachineID_sql)){
                    mysqli_stmt_bind_param($insertMachineID,"ddsssssdd", $cusID, $sysNo, $machineID,$_POST['purDate'],$_POST['Support'], $_POST['OS'],$_POST['Web'],$_POST['Java'],$_POST['PHP']);
                    mysqli_stmt_execute($insertMachineID);
                    mysqli_stmt_close($insertMachineID); 
                                    
                }

            }
            $_SESSION['machineID'] = $machineID;  

            // echo "<script type='text/javascript'> document.location ='appMidpage.php'</script>";
        }    
    }
    mysqli_close($conn);
    exit();

?>