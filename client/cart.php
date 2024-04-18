<?php
require_once "header.php";

if(isset($_POST['updateQuantity'])){
    $id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $quantity =  mysqli_real_escape_string($conn, $_POST['quantity']);
    $cart = json_decode($_COOKIE['cart'],true);
    $cartLength = count($cart);
    for ($i = 0; $i < count($cart); $i++) {
        if($cart[$i]['item_id'] == $id){
          $cart[$i]['item_quantity'] = $quantity;
          break; 
        }
      }
    setcookie('cart',json_encode($cart),time() + (86400 * 30));
    header('Location: cart.php');
}
if(isset($_POST['removeProduct'])){
    $id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $cart = json_decode($_COOKIE['cart'],true);
    $cartLength = count($cart);
    for ($i = 0; $i < $cartLength; $i++) {
        if($cart[$i]['item_id'] == $id){
            unset($cart[$i]);
        }
    }
    $cart = array_values($cart);
    setcookie('cart',json_encode($cart),time() + (86400 * 30));
    header('Location: cart.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                    <th>Total</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    if(isset($_COOKIE['cart'])){
                        $cart = json_decode($_COOKIE['cart'],true);
                        $cartLength = count($cart);
                        for ($i = 0; $i < $cartLength; $i++) {                          
                            $id = $cart[$i]['item_id'];
                            $quantity = $cart[$i]['item_quantity'];
                            $sql = "SELECT * FROM products WHERE id=$id";
                            $result = mysqli_query($conn,$sql);
                            $product = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $total += $product['price'] * $quantity;
                            echo "<tr>";
                            echo "<td><img src='../uploads/".$product['image']."' width='100' height='100'></td>";
                            echo "<td>".$product['name']."</td>";
                            echo "<td>".$product['price']."</td>";
                            echo "<td>".$quantity."</td>";
                            echo "<td>".$product['price'] * $quantity."</td>";
                            echo "<td>
                            <form action='' method='post'>
                              <input type='hidden' name='item_id' value='" . $product['id'] . "'>
                              <input type='number' name='quantity' value='" . $quantity . "' min='1' style='width: 30px;'>
                              <button type='submit' name='updateQuantity' class='btn btn-sm btn-primary'>Update</button>
                            </form>
                            <form action='' method='post'>
                              <input type='hidden' name='item_id' value='" . $product['id'] . "'>
                              <button type='submit' name='removeProduct' class='btn btn-sm btn-danger'>Remove</button>
                            </form>
                          </td>";
                        }    
                    }else {
                        echo "<tr><td colspan='6'>Your cart is empty</td></tr>";
                    }
                ?>

                <tr>
                    <td colspan="5">Total</td>
                    <td><?php echo $total; ?></td>
                </tr>
                
            </tbody>
        </table>
        <a href="checkout.php" class="btn btn-success">Checkout</a>
    </div>
</body>
</html>
