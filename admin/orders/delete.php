<?php

    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../login.php");
    }

if(isset($_GET['id'])){
    include("../../includes/db_connect.php");
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlDeleteOrderItems = "DELETE FROM order_items WHERE order_id = $id";
    if(mysqli_query($conn, $sqlDeleteOrderItems)){
        $sql = "DELETE FROM orders WHERE id = $id";
    }else{
        echo "Error: " . $sqlDeleteOrderItems . "<br>" . mysqli_error($conn);
    }
    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION['delete'] = "Order deleted successfully";
        header("Location: index.php");
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>