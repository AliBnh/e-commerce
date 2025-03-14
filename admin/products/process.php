<?php
require_once '../templates/header.php';


    include("../../includes/db_connect.php");

    if(isset($_POST['create'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = $_POST['price'];
        $cost_price = $_POST['cost_price'];
        $categoryId =  $_POST['categoryId'];
        $ram = $_POST['ram'];
        $storage = $_POST['storage'];

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
                $sql = "INSERT INTO products (name, description,price,cost_price,ram,storage,image,category_id) VALUES ('$name', '$description','$price','$cost_price','$ram','$storage','$fileName','$categoryId')";
            else
            $sql = "INSERT INTO products (name,price,cost_price,ram,storage,image,category_id) VALUES ('$name','$price','$cost_price','$ram','$storage','$fileName','$categoryId')";
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

        if (isset($_POST['edit'])) {
      $name = mysqli_real_escape_string($conn, $_POST['name']);
      $description = mysqli_real_escape_string($conn, $_POST['description']);
      $ram = $_POST['ram'];
      $storage = $_POST['storage'];
      $price = $_POST['price'];
      $cost_price = $_POST['cost_price'];
      $categoryId = $_POST['categoryId'];
      $id = mysqli_real_escape_string($conn, $_POST['id']);
    
      $fileName = $_FILES['image']['name'];
      $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
      $allowedTypes = array('jpg', 'jpeg', 'png','svg');
      $fileTmpName = $_FILES['image']['tmp_name'];
      $targetFilePath = "../../uploads/" . $fileName;
    
      if (!empty($_FILES['image']['name'])) {
        if (in_array($fileExt, $allowedTypes)) {
          if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            if(strlen($description)>0)
            $sql = "UPDATE products SET name='$name', description='$description',price='$price',cost_price='$cost_price',ram='$ram',storage='$storage',image='$fileName',category_id='$categoryId' WHERE id=$id";
            else
            $sql = "UPDATE products SET name='$name',price='$price',cost_price='$cost_price',ram='$ram',storage='$storage',image='$fileName',category_id='$categoryId' WHERE id=$id";
            if(mysqli_query($conn, $sql)){
                session_start();
                $_SESSION['update'] = "The Product has been updated successfully!";
                header("Location: index.php");
            }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }          } else {
            echo "Error uploading file";
            exit;
          }
        } else {
          echo "File type not allowed";
          exit;
        }
      } else {
        $sql = "SELECT image FROM products WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $existingImagePath = $row['image'];
    
        $sql = "UPDATE products SET name='$name', description='$description',price='$price',cost_price='$cost_price',ram='$ram',storage='$storage',image='$existingImagePath',category_id='$categoryId' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
          session_start();
          $_SESSION['update'] = "The Product has been updated successfully!";
          header("Location: index.php");
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
    }
    
    




?>
