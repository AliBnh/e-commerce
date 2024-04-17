<?php
    include("../../includes/db_connect.php");

    if(isset($_POST['edit'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $created_at = mysqli_real_escape_string($conn, $_POST['created_at']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);

        $sql = "UPDATE orders SET status = '$status', created_at = '$created_at', address = '$address', payment_method = '$payment_method', total = '$total' WHERE id = $id";

        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['update'] = "The order has been updated successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }



?>
