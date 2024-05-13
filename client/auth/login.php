<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
        <?php
        
            if(isset($_POST["login"])){
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "../../includes/db_connect.php";
                $sql = "SELECT * FROM users WHERE email = '$email' AND is_admin= false";
                $result = mysqli_query($conn,$sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if($user){
                     if(password_verify($password,$user["password"])){
                        session_start();
                        $_SESSION['user']="yes";
                        $sqlUsername = "SELECT * FROM users WHERE email = '$email'";
                        $resultUsername = mysqli_query($conn,$sqlUsername);
                        $userUsername = mysqli_fetch_array($resultUsername, MYSQLI_ASSOC);
                        $_SESSION['username']=$userUsername["username"];
                        $_SESSION['id']=$userUsername["id"];
                        header("Location: ../index.php");
                        die();
                    }else{
                        echo "<div class='alert alert-danger'>Password doesn t match </div>";
                    }
                }else{
                    echo "<div class='alert alert-danger'>Email doesn t match </div>";
                }
            }
        ?>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="input-box">
                <input type="email" placeholder="Email " name="email" class="form-control">
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password " name="password" class="form-control">
            </div>
            <div class="remember">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forget Password</a>
            </div>
            <button type="submit" value="Login" name="login" class="btnn">Login</button>
            <div class="button">
                <a href="registration.php">
                 Register Now     
                </a>
            </div>
        </form>
    </div>
</body>
</html>