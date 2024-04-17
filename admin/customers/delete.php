<?php


require_once '../templates/header.php';

if(isset($_GET['id'])){
    include("../../includes/db_connect.php");
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlCheckOrders = "SELECT * FROM orders WHERE user_id=$id";
    $resultCheckOrders = mysqli_query($conn, $sqlCheckOrders);
    if(mysqli_num_rows($resultCheckOrders) > 0){
        $sqlArchiveUser = "UPDATE users SET archived=1 WHERE id=$id";
        if(mysqli_query($conn, $sqlArchiveUser)){
            session_start();
            $_SESSION['delete'] = "The User has been archived successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sqlArchiveUser . "<br>" . mysqli_error($conn);
        }
    }else{
        $sql = "DELETE FROM users WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['delete'] = "The User has been deleted successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}


?>