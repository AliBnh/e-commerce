<?php
require_once '../templates/header.php';


    include("../../includes/db_connect.php");

    
    if(isset($_POST['create'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = $_POST['price'];
        $cost_price = $_POST['cost_price'];
        $categoryId =  $_POST['categoryId'];

        $fileName = $_FILES['image']['name'];
        $fileExt  = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png','svg');
        $fileTmpName = $_FILES['image']['tmp_name'];
        $targetFilePath = "../../uploads/".$fileName;

        
        $checkExistence = "SELECT * FROM products WHERE LOWER(name) = LOWER('$name')";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "Product with same name exists";
            exit;
        }else{

        if(in_array($fileExt, $allowedTypes)){
            if(move_uploaded_file($fileTmpName, $targetFilePath)){
                
            if(strlen($description)>0)
                $sql = "INSERT INTO products (name, description,price,cost_price,image,category_id) VALUES ('$name', '$description','$price','$cost_price','$fileName','$categoryId')";
            else
            $sql = "INSERT INTO products (name,price,cost_price,image,category_id) VALUES ('$name','$price','$cost_price','$fileName','$categoryId')";
            if(mysqli_query($conn, $sql)){
                session_start();
                $_SESSION['create'] = "The Product has been added successfully!";
                header("Location: index.php");
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }


            }else{
                echo "Error uploading file";
                exit;
            }

        }else{
            echo "File type not allowed";
            exit;
        }

    }
    }

    
    if(isset($_POST['edit'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $created_at = mysqli_real_escape_string($conn, $_POST['created_at']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);

        $sql = "UPDATE orders SET status = '$status', created_at = '$created_at', payment_method = '$payment_method', total = '$total' WHERE id = $id";

        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['update'] = "The order has been updated successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }



?>
