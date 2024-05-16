<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
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
    }
    .icon{
        width: 16px;
    }
    .table{
        text-align: center;
        vertical-align: middle; 
        background-color: white;
    }
    .heading{
        position: absolute;
        top: 50px;
        left: 50%;            
    }
    .selectBox{
        width: 100px;
        margin:0 auto;
        text-align: center;
    }
</style>
<body>
<div class="container">
        <header class="d-flex heading">
        </header>
        <?php
            if(!$_SESSION)
            session_start();
            if(isset($_SESSION['delete'])){
                echo "<div class='alert alert-success'>".$_SESSION['delete']."</div>";
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['create'])){
                echo "<div class='alert alert-success'>".$_SESSION['create']."</div>";
                unset($_SESSION['create']);
            }
            if(isset($_SESSION['update'])){
                echo "<div class='alert alert-success'>".$_SESSION['update']."</div>";
                unset($_SESSION['update']);
            }
        ?>
        <div class="d-flex mb-4 justify-content-around">
            <form action="" method="get">
                 <div class="d-flex ">
                    <input type="number" name="searchId" class="form-control" style="width: 220px;border-top-right-radius: 0px; border-bottom-right-radius:0px; " placeholder="Order ID">
                    <button type="submit" class="btn btn-primary" style="width: 80px; border-top-left-radius: 0px; border-bottom-left-radius:0px">Search</button>
                </div>
            </form>
            <form action="" method="get">
                <div class="d-flex">
                    <div class="">
                        <select name="sort" class="form-control" style="width: 220px;border-top-right-radius: 0px; border-bottom-right-radius:0px; ">
                            <option value="0">Sort by total</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" style="width: 80px; border-top-left-radius: 0px; border-bottom-left-radius:0px">Sort</button>
                </div>
            </form>
        </div>

        <table class="table " style="border-radius: 16px;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Order date</th>
                    <th>Payment method</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require_once "../../includes/db_connect.php";
            
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
                $orderId = $_POST['order_id'];
                $newStatus = $_POST['status'];
                $updateSql = "UPDATE orders SET status='$newStatus' WHERE id=$orderId";
                mysqli_query($conn, $updateSql);
                echo "<div class='alert alert-success'>Order status updated successfully.</div>";
            }

            if(isset($_GET['sort'])) {
                $sort = $_GET['sort'];
                if($sort == 'asc'){
                    $sql = "SELECT * FROM orders ORDER BY total ASC";
                } else if($sort == 'desc'){
                    $sql = "SELECT * FROM orders ORDER BY total DESC";
                } else {
                    $sql = "SELECT * FROM orders";
                }
            } elseif(isset($_GET['searchId']) && $_GET['searchId'] != '') {
                $id = $_GET['searchId'];
                $sql = "SELECT * FROM orders WHERE id=$id";
            } else {
                $sql = "SELECT * FROM orders";
            }

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['created_at']."</td>";
                    echo "<td>".$row['payment_method']."</td>";
                    echo "<td>
                            <form action='' method='post' class='selectBox'>
                                <input type='hidden' name='order_id' value='".$row['id']."'>
                                <select name='status' class='form-control' onchange='this.form.submit()'>
                                    <option value='pending' ".($row['status'] == 'pending' ? 'selected' : '').">Pending</option>
                                    <option value='processing' ".($row['status'] == 'processing' ? 'selected' : '').">Processing</option>
                                    <option value='shipped' ".($row['status'] == 'shipped' ? 'selected' : '').">Shipped</option>
                                    <option value='cancelled' ".($row['status'] == 'cancelled' ? 'selected' : '').">Cancelled</option>
                                </select>
                            </form>
                        </td>";
                    echo "<td>".$row['total']."</td>";
                    echo "<td>
                            <div class='btn-group'>
                                <a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>
                                <a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>
                            </div>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No Orders were found</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <a href="https://dashboard.stripe.com/test/payments" target="_blank" class="btn btn-primary my-4">View Payments</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
    setTimeout(function() {
        var alerts = document.getElementsByClassName('alert');
        for (var i = 0; i < alerts.length; i++) {
            alerts[i].style.display = 'none';
        }
    }, 1200);
</script>
</body>
</html>
