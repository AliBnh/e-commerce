<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="content">
        <?php
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $repeat_password = $_POST['repeat_password'];
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $errors = array();
                if(empty($username) OR empty($email) OR empty($password) OR empty($repeat_password)){
                    array_push($errors,"All fields are required");
                }
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    array_push($errors,"Email isn't valid");
                }
                // if(strlen($password)<8){
                //     array_push($errors,"Password must be at least 8 characters long");
                // }
                if($password !== $repeat_password){
                    array_push($errors,"Password doesn't match");
                }
                require_once "../../includes/db_connect.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $res = mysqli_query($conn,$sql);
                $rowCount = mysqli_num_rows($res);
                if($rowCount>0){
                    array_push($errors,"Email already exists");
                }
                if(count($errors)>0){
                    foreach($errors as $error)
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                else{
                    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$passwordHash')";
                    if(mysqli_query($conn, $sql)){
                         echo"<div class='alert alert-success'>Registered successfully</div>";
                         session_start();
                        $_SESSION['user']="yes";
                        $_SESSION['username']=$userUsername["username"];
                        $_SESSION['id']=$userUsername["id"];
                        header("Location: ../index.php");
                        die();
                    }else{
                        echo "Registration failed";
                    }
                }
            }
        ?>
        <h2>Sign up</h2>
        <form action="registration.php" method="post">
            <div class="input-box">
                <input type="text" name="username" class="form-control" placeholder="username" >
            </div>
            <div class="input-box">
                <input type="email" name="email" class="form-control" placeholder="email" >
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="password" class="form-control" >
            </div>
            <div class="input-box">
                <input type="password" name="repeat_password" class="form-control" placeholder="Repeat password" >
            </div>
            <button type="submit" value="register" name="submit" class="btnn">Sign up</button>
        </form>
        <div class="button">
                <p>Already registered <a href="login.php">Login here</a></p>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>