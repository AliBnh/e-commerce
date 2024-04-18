<?php
require_once "header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container">
    <header class="d-flex justify-content-between my-4">
        <h1 class="text-center my-4">Products</h1>
        <div>
            <a href="index.php" class="btn btn-primary">Back</a>
        </div>
    </header>
 
    <form action="products.php" method="get">
        <div class="row">
            <div class="col-md-3">
                <input type="number" name="min" class="form-control" placeholder="Min Price">
            </div>
            <div class="col-md-3">
                <input type="number" name="max" class="form-control" placeholder="Max Price">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-control">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?php 
            if(isset($_GET['id'])){
                echo $_GET['id'];
            } ?>">
        </div>
    </form>


    <?php
     echo "<div id='productsByCategory'>";
            if(isset($_GET['id'])){
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT * FROM products WHERE category_id = $id";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary'>View</a>";
                        //add to cart in cookies(update or add)
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            echo "</div>";
            if(isset($_GET['min']) || isset($_GET['max']) || isset($_GET['sort'])){
                echo "<script>document.getElementById('productsByCategory').style.display = 'none';</script>";
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $min = mysqli_real_escape_string($conn, $_GET['min']);
                $max = mysqli_real_escape_string($conn, $_GET['max']);
                if($min == ""){
                    $min = 0;
                }if($max == ""){
                    $max = 1000000;
                }if($min > $max){
                    $temp = $min;
                    $min = $max;
                    $max = $temp;
                }
                $sql = "";
                if(isset($_GET['sort'])){
                    $sort = mysqli_real_escape_string($conn, $_GET['sort']);
                    if($sort == 'asc'){
                        $sql = "SELECT * FROM products WHERE price >= $min AND price <= $max AND category_id = $id ORDER BY price ASC";
                    }else{
                        $sql = "SELECT * FROM products WHERE price >= $min AND price <= $max AND category_id = $id ORDER BY price DESC";
                    }
                }else{
                    $sql = "SELECT * FROM products WHERE price >= $min AND price <= $max AND category_id = $id";
                }
                $result = mysqli_query($conn, $sql);
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary'>View</a>";
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            if(isset($_GET['name'])){
                echo "<script>document.getElementById('productsByCategory').style.display = 'none';</script>";
                $name = mysqli_real_escape_string($conn, $_GET['name']);
                $sql = "SELECT * FROM products WHERE name LIKE '%$name%'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary'>View</a>";
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
            }
            // if(isset($_POST['add'])){
            //     $id = mysqli_real_escape_string($conn, $_POST['id']);
            //     $name = mysqli_real_escape_string($conn, $_POST['name']);
            //     $price = mysqli_real_escape_string($conn, $_POST['price']);
            //     $image = mysqli_real_escape_string($conn, $_POST['image']);
            //     $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

            //     if(isset($_COOKIE['cart'])){
            //         $cookie_data = stripslashes($_COOKIE['cart']);
            //         $cart_data = json_decode($cookie_data, true);
            //     }else{
            //         $cart_data = array();
            //     }
            //     $item_id_list = array_column($cart_data, 'item_id');
            //     if(in_array($id, $item_id_list)){
            //         foreach($cart_data as $keys => $values){
            //             if($cart_data[$keys]['item_id'] == $id){
            //                 $cart_data[$keys]['item_quantity'] = $cart_data[$keys]['item_quantity'] + $quantity;
            //             }
            //         }
            //     }else{
            //         $item_array = array(
            //             'item_id' => $id,
            //             'item_name' => $name,
            //             'item_price' => $price,
            //             'item_image' => $image,
            //             'item_quantity' => $quantity
            //         );
            //         $cart_data[] = $item_array;
            //     }
            //     $item_data = json_encode($cart_data);
            //     setcookie('cart', $item_data, time() + (86400 * 30));
            // }

            session_start(); // Start the PHP session
            
            if (isset($_POST['add'])) {
              $id = mysqli_real_escape_string($conn, $_POST['id']);
              $name = mysqli_real_escape_string($conn, $_POST['name']);
              $price = mysqli_real_escape_string($conn, $_PRICE['price']);
              $image = mysqli_real_escape_string($conn, $_POST['image']);
              $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
            
              // Check if a cart exists in the session
              if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array(); // Initialize an empty cart array
              }
            
              $cart_data = &$_SESSION['cart']; // Get a reference to the cart in the session
            
              $item_id_list = array_column($cart_data, 'item_id');
            
              if (in_array($id, $item_id_list)) {
                foreach ($cart_data as $keys => $values) {
                  if ($cart_data[$keys]['item_id'] == $id) {
                    $cart_data[$keys]['item_quantity'] = $cart_data[$keys]['item_quantity'] + $quantity;
                  }
                }
              } else {
                $item_array = array(
                  'item_id' => $id,
                  'item_name' => $name,
                  'item_price' => $price,
                  'item_image' => $image,
                  'item_quantity' => $quantity
                );
                $cart_data[] = $item_array; // Add the new item to the cart
              }
            
              // No need to encode/decode data as it's stored in the session directly
            }
            
            ?>
            
    ?>
    
</body>
</html>