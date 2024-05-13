<?php
require_once "./templates/navbar.php";
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
        require_once "../includes/db_connect.php";

        if(isset($_GET['id'])){
                    $id = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM products WHERE id = $id";
                    $result = mysqli_query($conn, $sql);                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<h2>".$row['name']."</h2>";
                            echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                            echo "<p><strong>Description: </strong>".$row['description']."</p>";
                            echo "<p><strong>Price: </strong>".$row['price']."</p>";  
                            $categoryId = $row['category_id'];
                            $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                            $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                            $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                            echo "<p><strong>category: </strong>".$categoryNameRow['name']."</p>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='id' value='".$row['id']."'>";
                            echo "<input type='hidden' name='name' value='".$row['name']."'>";
                            echo "<input type='hidden' name='price' value='".$row['price']."'>";
                            echo "<input type='hidden' name='image' value='".$row['image']."'>";
                            echo "<input type='hidden' name='quantity' value='1'>";
                            echo "<button type='submit' name='add' class='btn btn-success'>Add to Cart</button>";
                            echo "</form>";
                        }
                    }else{
                        echo "No Product found";
                    }
                }else{
                    header("Location: index.php");
                }
                if(isset($_POST['add'])){
                    $id = mysqli_real_escape_string($conn, $_POST['id']);
                    $name = mysqli_real_escape_string($conn, $_POST['name']);
                    $price = mysqli_real_escape_string($conn, $_POST['price']);
                    $image = mysqli_real_escape_string($conn, $_POST['image']);
                    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    
                    if(isset($_COOKIE['cart'])){
                        $cookie_data = stripslashes($_COOKIE['cart']);
                        $cart_data = json_decode($cookie_data, true);
                    }else{
                        $cart_data = array();
                    }
                    $item_id_list = array_column($cart_data, 'item_id');
                    if(in_array($id, $item_id_list)){
                        foreach($cart_data as $keys => $values){
                            if($cart_data[$keys]['item_id'] == $id){
                                $cart_data[$keys]['item_quantity'] = $cart_data[$keys]['item_quantity'] + $quantity;
                            }
                        }
                    }else{
                        $item_array = array(
                            'item_id' => $id,
                            'item_name' => $name,
                            'item_price' => $price,
                            'item_image' => $image,
                            'item_quantity' => $quantity
                        );
                        $cart_data[] = $item_array;
                    }
                    $item_data = json_encode($cart_data);
                    setcookie('cart', $item_data, time() + (86400 * 30));
                }
            ?>
        </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>