<?php
    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword="";
    $dbName="ecommerce";
    
    $conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);

    if(!$conn){
        die("Couldn't connect to the database");
    }

?>