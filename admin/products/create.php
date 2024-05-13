<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            <h1 class="text-center my-4">Add new Products</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <form action="process.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-element my-4">
                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="form-element my-4">
                    <input type="text" name="description" class="form-control" placeholder="Description">
                </div>
                <div class="form-element my-4">
                    <input type="number" name="price" class="form-control" placeholder="Selling Price" required>
                </div>
                <div class="form-element my-4">
                    <input type="number" name="cost_price" class="form-control" placeholder="Costing Price" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-element my-4">
                    <input type="number" name="ram" class="form-control" placeholder="RAM" required>
                </div>
                <div class="form-element my-4">
                    <input type="number" name="storage" class="form-control" placeholder="Storage" required>
                </div>
                <select name="categoryId" class="form-control my-4" required>
                    <?php
                        require_once "../../includes/db_connect.php";
                        $sql = "SELECT * FROM categories WHERE archived = 0";
                        $result = mysqli_query($conn, $sql);
                        echo "<option value=''>Select Category</option>";
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['id']."'>".$row['name']."</option>";
                            }
                        }
                    ?>
                </select>
                <div class="form-element my-4">
                    <input type="file" name="image" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="form-element">
            <input type="submit" class="btn btn-success" name="create" value="Add Product">
        </div>
    </form>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>