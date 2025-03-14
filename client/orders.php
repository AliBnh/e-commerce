<?php
require_once "./templates/navbar.php";
if(!isset($_SESSION['user'])){
    header("Location: ./auth/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
        body{
        background-color: #f8f9fa;
        /* background: url(../uploads/gradient.jpg); */

    }
        .icon{
        width: 16px;
    }
    .table{
        text-align: center;
        vertical-align: middle; 
        background-color: white;
    }
    .container{
        width: 50%;
        margin: 0 auto;
        margin-top: 50px;

    }
    .theadprimary{
        background-color: #343a40;
        color: white;
    }
    .innerTable{
        border: 1px solid #dee2e6;
        border-radius: 16px;
        margin-bottom: 40px;
    }
    h2{
        color: #343a40;
        margin-bottom: 30px;
    }

    </style>
<body>
    <div class="container">
    <header class="  ">
            <h2 class="text-center ">Orders History</h2>
        </header>       
        <table class="table " style="border-radius: 26px;">
            <tbody>
                <?php
                include("../includes/db_connect.php");
                $id= $_SESSION['id'];
                $sql = "SELECT * FROM orders WHERE user_id = $id ORDER BY created_at DESC";
                $result = mysqli_query($conn, $sql);                
                while($row = mysqli_fetch_array($result)){
                    $order_id = $row['id'];
                    $totalOrder = $row['total'];
                    $order_date = $row['created_at'];
                    $status = $row['status'];
            
                    echo "<p>";
                    echo "<td>$order_id</td>";
                    echo "<td>$status</td>";
                    echo "<td>$order_date</td>";
                    echo "<td>$totalOrder</td>";
                    echo "</p>";
                    echo "</div>";
                    $orderItemsSql = "SELECT * FROM order_items WHERE order_id = $order_id";
                    $orderItemsResult = mysqli_query($conn, $orderItemsSql);

                    echo "<tr>";
                    echo "<td colspan='5'>"; 
                    echo "<table class='table innerTable'>"; 
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Product</th>";
                    echo "<th>Name</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Price</th>";
                    echo "<th>Total</th>";
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    while($orderItem = mysqli_fetch_array($orderItemsResult)){
                        $product_id = $orderItem['product_id'];
                        $quantity = $orderItem['quantity'];
                        $productSql = "SELECT * FROM products WHERE id = $product_id";
                        $productResult = mysqli_query($conn, $productSql);
                        $product = mysqli_fetch_array($productResult);
                        $product_name = $product['name'];
                        $total = $orderItem['total'] ;
                        $product_price = $product['price'];
                        $product_image = $product['image'];
                        echo "<tr>";
                        echo "<td><img src='../uploads/".$product_image."' width='100' height='100'></td>";
                        echo "<td>$product_name</td>";
                        echo "<td>$quantity</td>";
                        echo "<td>$product_price</td>";
                        echo "<td>$total</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>"; // Close nested table for order items
                    echo "</td>"; // Close cell spanning all 4 columns
                    echo "</tr>";

                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
