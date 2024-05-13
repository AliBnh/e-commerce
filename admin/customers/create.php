<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
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
<div class="container" 
    style="
    width: 90%;
    border: 1px solid #ccc ;
    border-radius: 10px;
    padding: 30px;
    margin: 20px auto;
    ">        
    <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Add new user</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <form action="process.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-element my-4">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-element my-4">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-element my-4">
                    <input type="text" name="address" class="form-control" placeholder="Address">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-element my-4">
                    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                </div>
                <div class="form-element my-4">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group my-4" style="text-align: left;">
                    <div class="form-check">
                        <input type="radio" name="is_admin" value="1" class="form-check-input" id="adminRadio">
                        <label for="adminRadio" class="form-check-label">Admin</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="is_admin" value="0" class="form-check-input" id="customerRadio" checked>
                        <label for="customerRadio" class="form-check-label">Customer</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-element">
            <input type="submit" class="btn btn-success" name="create" value="Save" style="width: 100px;">
        </div>
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>