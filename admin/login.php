<?php
    session_start();
    if(isset($_SESSION['user'])){
        header("Location: ./categories/index.php");
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <div class="content">
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "../includes/db_connect.php";
            $sql = "SELECT * FROM users WHERE email = '$email' AND is_admin= true";
            $result = mysqli_query($conn,$sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                 if(password_verify($password,$user["password"])){
                    // if($password==$user["password"]){
                    session_start();
                    $_SESSION['user']="yes";
                    $_SESSION['id']=$user['id'];
                    $_SESSION['username']=$user['username'];
                    
                    header("Location: ./products/index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password doesn t match </div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email doesn t match </div>";
            }
        }
        ?>
        <form action="" method="post">
            <h2>Login</h2>
            <div class="input-box">
            <input type="email" placeholder="Email " name="email" class="form-control">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
            <div class="input-box">
            <input type="password" placeholder="Password " name="password" class="form-control">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="remember">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forget Password</a>
            </div>
            <button type="submit" value="Login" name="login" class="btnn">Login</button>
            <div class="button">
                <a href="#">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#">
                    <i class="fab fa-google"></i>
                </a>
            </div>
        </form>
    </div>
 </body>
</html>