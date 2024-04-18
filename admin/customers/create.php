<?php
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Add new user</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <form action="process.php" method="post">

            <div class="form-element my-4">
                <input type="text" name="username" class="form-control" placeholder="Username "   required>
            </div>
            <div class="form-element my-4">
                <input type="email" name="email" class="form-control" placeholder="Email " required>
            </div>
            <div class="form-element my-4">
                <input type="text" name="address" class="form-control" placeholder="Address " >
            </div>
            <div class="form-element my-4">
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number " >
            </div>
            <div class="form-element my-4">
                <input type="password" name="password" class="form-control" placeholder="Password " required>
            </div>
            <div class="form-element my-4">
                <input type="radio" name="is_admin" value="1" > Admin
                <input type="radio" name="is_admin" value="0" checked> Customer
            </div>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="create" value="Save">
            </div>
        </form>
        <a href="../logout.php" class="btn btn-warning ">Logout</a>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>