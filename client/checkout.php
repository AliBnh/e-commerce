<?php
require_once "./templates/navbar.php";
if(!isset($_SESSION['user'])){
    header("Location: ./auth/login.php");
}
ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
<div class="container" 
    style="
    width: 50%;
    border: 1px solid #ccc ;
    border-radius: 10px;
    padding: 30px;
    margin: 30px auto;
    margin-top: 80px;

    ">    <h2>Checkout</h2>
    <form action="" method="post">
        <?php
        include("../includes/db_connect.php");
        $id= $_SESSION['id'];
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        ?>

<div class="row">
        <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['username']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $row['phone_number']; ?>" required>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>" required>
        </div>
        <div class="form-group">
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" class="form-select" required>
            <option value="cash_on_delivery">Cash on delivery</option>
            <option value="credit_card">Card</option>
        </select>
        </div>
        </div>
        <div class="mt-4">
        <h5>Order Summary</h5>
        <hr/>
        <?php
        $cart = json_decode($_COOKIE['cart'],true);
        $cartLength = count($cart);
        $total = 0;
        for ($i = 0; $i < $cartLength; $i++) {  
            $id = $cart[$i]['item_id'];
            $quantity = $cart[$i]['item_quantity'];
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = mysqli_query($conn,$sql);
            $product = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $total += $product['price'] * $quantity;
            echo "<li>".$product['name']." - ".$product['price']." x ".$quantity."</li>";
        }
        echo "<p><strong>Total: ".$total."</strong></p>";
        echo "<input type='hidden' name='total' value='".$total."'>";
        ?>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="checkout" value="Checkout">
        </div>

    </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['checkout'])){
    include("../includes/db_connect.php");

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    $user_id = $_SESSION['id'];
    $sqlUpdateUser = "UPDATE users SET username = '$name', email = '$email', phone_number = '$phone', address = '$address' WHERE id = $user_id";
    mysqli_query($conn, $sqlUpdateUser);



    $sql = "INSERT INTO orders (user_id, total,payment_method) VALUES ('$user_id','$total','$payment_method')";
    mysqli_query($conn, $sql);
    $sqlGetOrderId = "SELECT id FROM orders WHERE user_id = $user_id ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sqlGetOrderId);
    $row = mysqli_fetch_array($result);
    $order_id = $row['id'];
        $cart = json_decode($_COOKIE['cart'],true);
        $cartLength = count($cart);
        $total = 0;
        for ($i = 0; $i < $cartLength; $i++) {  
            $id = $cart[$i]['item_id'];
            $quantity = $cart[$i]['item_quantity'];
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = mysqli_query($conn,$sql);
            $product = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $total = $product['price'] * $quantity;
            $sqlInsertOrderDetails = "INSERT INTO order_items (order_id, product_id, quantity, total) VALUES ('$order_id','$id','$quantity','$total')";
            mysqli_query($conn, $sqlInsertOrderDetails);

    }
    setcookie('cart', '', time() - 3600);
    if($_POST['payment_method'] == 'credit_card'){
        require "../vendor/autoload.php";
        $stripe_secret_key = "sk_test_51OhG8vCDQGH9qTAvml4xFFTcLfwDqt5IKjqLHKArtniKB37iRpjfJCk8K9KPltHJegFKitfWqhCUnhYZDQ6WIrZk00nNaJLfRo";
        \Stripe\Stripe::setApiKey($stripe_secret_key);
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/ecommerce/client/orders.php",
            "cancel_url" => "http://localhost/ecommerce/client/cart.php",
            "locale" => "auto",
            "payment_method_types" => ["card"],
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "usd",
                        "unit_amount" => $total*100,
                        "product_data" => [
                            "name" => "Order #".$order_id
                        ]
                    ]
                ]
            ]
        ]);
        http_response_code(303);
        header("Location: " . $checkout_session->url);
        exit;
    }
    header("Location: ./index.php");
}
ob_end_flush();


?>
