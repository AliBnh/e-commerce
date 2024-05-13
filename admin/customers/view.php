<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
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
            text-align: left;
        }
        body{
        background-color: #f8f9fa;
        }
        .container{
        background-color: white;    
    }
    .list{
            list-style: none;
            line-height: 2;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container" 
    style="
    width: 90%;
    border-radius: 10px;
    padding: 30px;
    margin: 20px auto;
    ">       <header class="d-flex justify-content-between ">

            <h1 class="text-center ">Customer Details</h1>
            <div>
                <a href="index.php" class="btn btn-primary my-4 mx-2">Back</a>
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
                            echo "<h3 >".$row['username']."</h3>";
                            echo "<ul class='list'>";
                            echo "<li><strong>Email: </strong>".$row['email']."</li>";
                            echo "<li><strong>Address: </strong>".$row['address']."</li>";  
                            echo "<li><strong>Phone number: </strong>".$row['phone_number']."</li>";  
                            echo "</ul>";
                            echo "<h4>Orders</h4>";
                            if(count($orderIds) > 0){
                                echo "<ul class='list'>";
                                foreach($orderIds as $orderId){
                                    echo "<li><strong><a href='../orders/view.php?id=".$orderId."'>Order ID: ".$orderId."</a></strong></li>";
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