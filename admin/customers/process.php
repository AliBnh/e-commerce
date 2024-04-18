<?php

    require_once '../templates/header.php';
    include("../../includes/db_connect.php");

    if(isset($_POST['create'])){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $is_admin = mysqli_real_escape_string($conn, $_POST['is_admin']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $checkExistence = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email') ";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "User with this email $email exists";
            exit;
        }else{
        $sql = "INSERT INTO users (username,email,password,address,phone_number,is_admin) VALUES ('$username','$email','$passwordHash','$address','$phone_number','$is_admin')";
        if(mysqli_query($conn, $sql)){
            session_start();
            $_SESSION['create'] = "The User has been created successfully!";
            header("Location: index.php");
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
}

    if(isset($_POST['edit'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);

        $checkExistence = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email') AND id != $id";
        $result = mysqli_query($conn, $checkExistence);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            echo "User with this email $email exists";
            exit;
        }else{
        $sql = "UPDATE users SET username='$name', email='$email', address='$address',phone_number='$phone' WHERE id=$id";
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
