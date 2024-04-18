<?php
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .category-details{
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Product Details</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="category-details my-4">
            <?php
        require_once "../../includes/db_connect.php";
        if(isset($_GET['id'])){
                    $id = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM products WHERE id = $id";
                    $result = mysqli_query($conn, $sql);                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<h2>".$row['name']."</h2>";
                            echo "<img src='../../uploads/".$row['image']."' width='100' height='100'>";
                            echo "<p><strong>Description: </strong>".$row['description']."</p>";
                            echo "<p><strong>Selling Price: </strong>".$row['price']."</p>";  
                            echo "<p><strong>Cost Price: </strong>".$row['cost_price']."</p>";  
                            echo "<p><strong>stock: </strong>".$row['stock']."</p>";
                            $categoryId = $row['category_id'];
                            $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                            $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                            $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                            echo "<p><strong>category: </strong>".$categoryNameRow['name']."</p>";
                        }
                    }else{
                        echo "No Product found";
                    }
                }else{
                    header("Location: index.php");
                }
            ?>
        </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>