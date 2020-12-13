<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "77777777";
    $databasename = "COVID";
    
    $conn = mysqli_connect($servername,$username,$password,$databasename,3306);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
?>