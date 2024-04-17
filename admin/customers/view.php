<?php
require_once '../templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer details</title>
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
            <h1 class="text-center my-4">Customer Details</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <div class="category-details my-4">
            <?php
        require_once "../../includes/db_connect.php";
        if(isset($_GET['id'])){
                    $id = mysqli_real_escape_string($conn, $_GET['id']);
                    $sql = "SELECT * FROM users WHERE id = $id";
                    $result = mysqli_query($conn, $sql);
                    $sqlOrderIds = "SELECT id FROM orders WHERE user_id = $id";
                    $resultOrderIds = mysqli_query($conn, $sqlOrderIds);
                    $orderIds = [];
                    if(mysqli_num_rows($resultOrderIds) > 0){
                        while($rowOrderIds = mysqli_fetch_assoc($resultOrderIds)){
                            $orderIds[] = $rowOrderIds['id'];
                        }
                    }                    
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<h2>".$row['username']."</h2>";
                            echo "<p><strong>Email: </strong>".$row['email']."</p>";
                            echo "<p><strong>Address: </strong>".$row['address']."</p>";  
                            echo "<h4>Orders</h4>";
                            if(count($orderIds) > 0){
                                echo "<ul>";
                                foreach($orderIds as $orderId){
                                    echo "<li><a href='../orders/view.php?id=".$orderId."'>Order ID: ".$orderId."</a></li>";
                                }
                                echo "</ul>";
                            }else{
                                echo "<p>No orders found</p>";
                            }
                            
                        }
                    }else{
                        echo "No such Customer found";
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