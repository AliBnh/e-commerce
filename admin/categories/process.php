<?php
require_once '../templates/header.php';

    include("../../includes/db_connect.php");
    if(isset($_POST['create'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);

        $fileName = $_FILES['image']['name'];
        $fileExt  = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png','svg');
        $fileTmpName = $_FILES['image']['tmp_name'];
        $targetFilePath = "../../uploads/".$fileName;

        $checkExistence = "SELECT * FROM categories WHERE LOWER(name) = LOWER('$name')";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "Category exists";
            exit;
        }else{
        if(in_array($fileExt, $allowedTypes)){
            if(move_uploaded_file($fileTmpName, $targetFilePath)){
            $sql = "INSERT INTO categories (name, description, image) VALUES ('$name', '$categoryDescription','$filename')";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['create'] = "The category has been added successfully!";
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
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $categoryDescription = mysqli_real_escape_string($conn, $_POST['categoryDescription']);

        $image = $_FILES['image']['name'];
        $fileExt = pathinfo($image, PATHINFO_EXTENSION);
        $allowedTypes = array('jpg', 'jpeg', 'png','svg');
        $fileTmpName = $_FILES['image']['tmp_name'];
        $targetFilePath = "../../uploads/" . $image;
      
        if (!empty($_FILES['image']['name'])) {
            if (in_array($fileExt, $allowedTypes)) {
              if (move_uploaded_file($fileTmpName, $targetFilePath)) {
            if(strlen($categoryDescription)>0)
            $sql = "UPDATE categories SET name='$name', description='$categoryDescription', image='$image' WHERE id=$id";
            else
            $sql = "UPDATE categories SET name='$name',image='$image' WHERE id=$id";

        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['update'] = "The category has been updated successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        echo "Error uploading file";
        exit;
      }
    }else {
        $sql = "SELECT image FROM categories WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $existingImagePath = $row['image'];
    
        $sql = "UPDATE categories SET name='$name', description='$categoryDescription', image='$existingImagePath' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
          session_start();
          $_SESSION['update'] = "The category has been updated successfully!";
          header("Location: index.php");
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }}

    }
?>
