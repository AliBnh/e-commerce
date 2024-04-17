<?php

require_once '../templates/header.php';
    include("../../includes/db_connect.php");

    if(isset($_POST['edit'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $checkExistence = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email') AND id != $id";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "User with this email $email exists";
            exit;
        }else{
        $sql = "UPDATE users SET username='$name', email='$email',address='$address' WHERE id=$id";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['update'] = "The User has been updated successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
}



?>
