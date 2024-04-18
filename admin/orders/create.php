<?php
require_once '../templates/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Place Order</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <select name="status"  class="form-element my-4" required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="shipped">Shipped</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <select name="paymentMethod"  class="form-element my-4" required>
                <option value="cash_on_delivery">Cash</option>
                <option value="credit_card">Credit Card</option>
            </select>
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="create" value="Add Product">
            </div>
        </form>
        <a href="../logout.php" class="btn btn-warning ">Logout</a>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>