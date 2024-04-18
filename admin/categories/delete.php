<?php
require_once '../templates/header.php';
if(isset($_GET['id'])){
    include("../../includes/db_connect.php");
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlCheckProducts = "SELECT * FROM products WHERE category_id=$id";
    $resultCheckProducts = mysqli_query($conn, $sqlCheckProducts);
    if(mysqli_num_rows($resultCheckProducts) > 0){
        while($row = mysqli_fetch_assoc($resultCheckProducts)){
            $productId = $row['id'];
            $sqlArchiveProduct = "UPDATE products SET archived=1 WHERE id=$productId";
            if(mysqli_query($conn, $sqlArchiveProduct)){
                continue;
            }else{
                echo "Error: " . $sqlArchiveProduct . "<br>" . mysqli_error($conn);
            }
        }
        $sqlArchiveCategory = "UPDATE categories SET archived=1 WHERE id=$id";
        if(mysqli_query($conn, $sqlArchiveCategory)){
            session_start();
            $_SESSION['delete'] = "The Category has been archived successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sqlArchiveCategory . "<br>" . mysqli_error($conn);
        }
    }else{
        $sql = "DELETE FROM categories WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['delete'] = "The Category has been deleted successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

}


?>