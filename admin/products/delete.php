<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
}

if(isset($_GET['id'])){
    include("../../includes/db_connect.php");
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sqlCheckExistenceInOrderItems = "SELECT * FROM order_items WHERE product_id = $id";
    $result = mysqli_query($conn, $sqlCheckExistenceInOrderItems);
    if(mysqli_num_rows($result) > 0){
        $sqlArchiveProduct = "UPDATE products SET archived = 1 WHERE id = $id";
        if(mysqli_query($conn, $sqlArchiveProduct)){
            session_start();
            $_SESSION['delete'] = "Product archived successfully since it is in an order item.";
            header("Location: index.php");
        }else{
            echo "Error: " . $sqlArchiveProduct . "<br>" . mysqli_error($conn);
        }
    }else{
        $sql = "DELETE FROM products WHERE id = $id";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['delete'] = "Product deleted successfully";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


}


?>