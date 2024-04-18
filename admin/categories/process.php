<?php
require_once '../templates/header.php';

    include("../../includes/db_connect.php");
    if(isset($_POST['create'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);
        $checkExistence = "SELECT * FROM categories WHERE LOWER(name) = LOWER('$name')";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "Category exists";
            exit;
        }else{
        if(strlen($categoryDescription)>0)
            $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
        else
            $sql = "INSERT INTO categories (name) VALUES ('$name')";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['create'] = "The category has been added successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    }
    if(isset($_POST['edit'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);

            if(strlen($categoryDescription)>0)
            $sql = "UPDATE categories SET name='$name', description='$categoryDescription' WHERE id=$id";
            else
            $sql = "UPDATE categories SET name='$name' WHERE id=$id";

        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['update'] = "The category has been updated successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }


?>
