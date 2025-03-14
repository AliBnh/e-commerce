<?php
    require_once '../templates/header.php';
    require_once '../templates/sidebar.php';
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<style>
    body{
        background-color: #f8f9fa;
    }
    .container{
        background-color: white;  
        border-radius: 16px;  
        padding: 30px;
        margin: 20px auto;
        width: 50%;
        
    }
</style>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center ">Edit Profile</h1>
            <div>
                <a href="index.php" class="btn btn-primary my-4">Cancel</a>
            </div>
        </header>
        <?php
            include("../../includes/db_connect.php");
            if(isset($_GET)){
                $id= $_SESSION['id'];
                $sql = "SELECT * FROM users WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
        ?> 
        <form action="" method="post">

            <div class="form-element my-4">
                <input type="text" name="username" class="form-control" placeholder="Username "  value="<?php echo $row["username"];?>" required>
            </div>
            <div class="form-element my-4">
                <input type="email" name="email" value="<?php echo $row["email"];?>" class="form-control" placeholder="Email  " required>
            </div>
            <div class="form-element my-4">
                <input type="password" name="password" class="form-control" placeholder="New Password" >
            </div>
            <div class="form-element my-4">
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" >
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="edit" value="Save">
            </div>
        </form>
        <?php
            }
        ?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
<?php

if(isset($_POST['edit'])){
    $id= $_SESSION['id'];
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $checkExistence = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email') AND id != $id";
    $result = mysqli_query($conn, $checkExistence);
    $numRows = mysqli_num_rows($result);
    if($numRows > 0){
        echo "User with this email $email exists";
        exit;
    }else{
            if(strlen($password)>0){
                if($password != $confirm_password){
                    echo "Passwords do not match";
                    exit;
                }
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE users SET username='$name', email='$email', password='$passwordHash' WHERE id=$id";
                if(mysqli_query($conn, $sql))
                    header("Location: ./products/index.php");    
            }else{
                    $sql = "UPDATE users SET username='$name', email='$email' WHERE id=$id";
                    if(mysqli_query($conn, $sql)){
                        header("Location: ./products/index.php");
                    }else{
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
}                
    }
    ob_end_flush();
}   