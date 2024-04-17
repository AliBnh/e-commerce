<?php
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Items</title>
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
            <h1 class="text-center my-4">Order Items</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="category-details my-4">
            <?php
        require_once "../../includes/db_connect.php";
        if(isset($_GET['id'])){
                    $id = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM orders WHERE id = $id";
                    $result = mysqli_query($conn, $sql);                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<h3>Order ID: ".$row['id']."</h3>";
                            echo "<p>Order Status: ".$row['status']."</p>";
                            echo "<p>Order Date: ".$row['created_at']."</p>";
                            echo "<p>Address: ".$row['address']."</p>";
                            echo "<p>Payment Method: ".$row['payment_method']."</p>";
                            echo "<p>Total: ".$row['total']."</p>";
                            echo "<p>Customer Details: <a href='../customers/view.php?id=".$row['user_id']."' class='btn btn-info'>View</a></p>";
                            echo "<h4>Order Items</h4>";
                            $sql2 = "SELECT * FROM order_items WHERE order_id = $id";
                            $result2 = mysqli_query($conn, $sql2);
                            if(mysqli_num_rows($result2) > 0){
                                echo "<table class='table table-bordered'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Product Name</th>";
                                echo "<th>Quantity</th>";
                                echo "<th>Price</th>";
                                echo "<th>Total</th>";
                                echo "<th>Product Details</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row2 = mysqli_fetch_assoc($result2)){
                                    $productId = $row2['product_id'];
                                    $productSql = "SELECT name,price FROM products WHERE id = $productId";
                                    $productResult = mysqli_query($conn, $productSql);
                                    $productRow = mysqli_fetch_assoc($productResult);
                                    
                                    echo "<tr>";
                                    echo "<td>".$productRow['name']."</td>";
                                    echo "<td>".$row2['quantity']."</td>";
                                    echo "<td>".$productRow['price']."</td>";
                                    echo "<td>".$row2['total']."</td>";
                                    $sqlCheckIfProductArchived  = "SELECT archived FROM products WHERE id = $productId";
                                    $resultCheckIfProductArchived = mysqli_query($conn, $sqlCheckIfProductArchived);
                                    $rowCheckIfProductArchived = mysqli_fetch_assoc($resultCheckIfProductArchived);
                                    if($rowCheckIfProductArchived['archived'] == 1){
                                        echo "<td>Product Archived</td>";
                                    }else{
                                        echo "<td><a href='../products/view.php?id=".$productId."' class='btn btn-info'>View</a></td>";
                                    }
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }else{
                                echo "No Order Items found";
                            }

                        }
                    }else{
                        echo "No Order found";
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