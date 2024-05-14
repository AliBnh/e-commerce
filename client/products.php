<?php
require_once "./templates/navbar.php";
ob_start();
$sql = "SELECT storage, ram FROM products WHERE archived=0";
$result = mysqli_query($conn, $sql);
$storages = array();
$rams = array();
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $storages[] = $row['storage'];
        $rams[] = $row['ram'];
    }
}
$storages = array_unique($storages);
$rams = array_unique($rams);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
    .box{
        width:11%;
        border: 0.1px solid gainsboro;
        border-radius: 10px;
        margin-right: 10px;
    }
    .rowing{
        text-align: center;
    }
    body{
        background: #f5f5f5;
        /* background: url(../uploads/gradient.jpg); */

    }
    .addCartBtn{
        background-color: #28a745;
        border: 1px solid #28a745;
    
    }
    .viewBtn{
        background-color: #007bff;
        border: 1px solid #007bff;
    
    }
</style>
<body>

<div class="container">
    <header class="d-flex justify-content-between my-4">
        <h1 class="text-center my-4">Products</h1>
    </header>
 
    <form action="products.php" method="get">
        <div class="row">
            <div class="col-2">
                <input type="number" name="min" class="form-control" placeholder="Min Price">
            </div>
            <div class="col-2">
                <input type="number" name="max" class="form-control" placeholder="Max Price">
            </div>
                <select name="minram" class="box">
                    <option value="">Min Ram</option>
                    <?php
                        foreach($rams as $ram){
                            echo "<option value='".$ram."'>".$ram."</option>";
                        }
                    ?>
                </select>          
                <select name="maxram" class="box">
                    <option value="">Max Ram</option>
                    <?php
                        foreach($rams as $ram){
                            echo "<option value='".$ram."'>".$ram."</option>";
                        }
                    ?>
                </select>
                <select name="minstorage" class="box">
                    <option value="">Min Storage</option>
                    <?php
                        foreach($storages as $storage){
                            echo "<option value='".$storage."'>".$storage."</option>";
                        }
                    ?>
                </select>
                <select name="maxstorage" class="box">
                    <option value="">Max Storage</option>
                    <?php
                        foreach($storages as $storage){
                            echo "<option value='".$storage."'>".$storage."</option>";
                        }
                    ?>
                </select>
                <select name="sort" class="box">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            <div class="col">
                <button type="submit" class="btn btn-primary px-3">Filter</button>
            </div>
        </div>

        <input type="hidden" name="id" value="<?php 
            if(isset($_GET['id'])){
                echo $_GET['id'];
            } ?>">
    </form>


    <?php
     echo "<div id='productsByCategory'>";
            if(isset($_GET['id'])){
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT * FROM products WHERE category_id = $id AND archived=0";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='row rowing'>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3 my-2'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<div class='d-flex  justify-content-evenly '>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary viewBtn' style='width:110px; height:41px;'>View</a>";

                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success addCartBtn' style='width:110px; height:41px;'>Add to Crt</button>";
                        // <i class='fa fa-cart-plus' aria-hidden='true'></i> 
                        echo "</form>";
                        echo"</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            }
            echo "</div>";
            if(isset($_GET['min']) || isset($_GET['max']) || isset($_GET['sort'] ) || isset($_GET['minram']) || isset($_GET['maxram']) || isset($_GET['minstorage']) || isset($_GET['maxstorage']) ){
                echo "<script>document.getElementById('productsByCategory').style.display = 'none';</script>";
                $id = mysqli_real_escape_string($conn, $_GET['id']);
                $min = mysqli_real_escape_string($conn, $_GET['min']);
                $max = mysqli_real_escape_string($conn, $_GET['max']);
                $minram = mysqli_real_escape_string($conn, $_GET['minram']);
                $maxram = mysqli_real_escape_string($conn, $_GET['maxram']);
                $minstorage = mysqli_real_escape_string($conn, $_GET['minstorage']);
                $maxstorage = mysqli_real_escape_string($conn, $_GET['maxstorage']);

                if($min == ""){
                    $min = 0;
                }if($max == ""){
                    $max = 1000000;
                }if($min > $max){
                    $temp = $min;
                    $min = $max;
                    $max = $temp;
                }
                
                if($minram == ""){
                    $minram = 0;
                }if($maxram == ""){
                    $maxram = 1000000;
                }if($minram > $maxram){
                    $temp = $minram;
                    $minram = $maxram;
                    $maxram = $temp;
                }

                if($minstorage == ""){
                    $minstorage = 0;
                }if($maxstorage == ""){
                    $maxstorage = 1000000;
                }if($minstorage > $maxstorage){
                    $temp = $minstorage;
                    $minstorage = $maxstorage;
                    $maxstorage = $temp;
                }


                $sql = "";
                if(isset($_GET['sort'])){
                    $sort = mysqli_real_escape_string($conn, $_GET['sort']);
                    if($sort == 'asc'){
                        $sql = "SELECT * FROM products WHERE price >= $min AND price <= $max AND archived=0 AND category_id = $id AND ram >= $minram AND ram <= $maxram AND storage >= $minstorage AND storage <= $maxstorage ORDER BY price ASC";
                    }else{
                        $sql = "SELECT * FROM products WHERE price >= $min AND price <= $max  AND archived=0 AND category_id = $id AND ram >= $minram AND ram <= $maxram AND storage >= $minstorage AND storage <= $maxstorage ORDER BY price DESC";
                    }
                }else{
                    $sql = "SELECT * FROM products WHERE price >= $min  AND archived=0 AND price <= $max AND category_id = $id AND ram >= $minram AND ram <= $maxram AND storage >= $minstorage AND storage <= $maxstorage"; 
                }
                $result = mysqli_query($conn, $sql);
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='row rowing'>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3 my-2'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<div class='d-flex  justify-content-evenly '>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary addCartBtn ' style='width:110px; height:41px;'>View</a>";
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success viewBtn' style='width:110px; height:41px;'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";

                    }
                    echo "</div>";

                }else{
                    echo "<h3>No products found</h3>";
                }
            }
            if(isset($_GET['name'])){
                echo "<script>document.getElementById('productsByCategory').style.display = 'none';</script>";
                $name = mysqli_real_escape_string($conn, $_GET['name']);
                $sql = "SELECT * FROM products WHERE name LIKE '%$name%' AND archived=0";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='row rowing'>";

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='col-md-3 my-2'>";
                        echo "<div class='card'>";
                        echo "<div class='card-body'>";
                        echo "<img src='../uploads/".$row['image']."' width='100' height='100'>";
                        echo "<h5 class='card-title'>".$row['name']."</h5>";
                        echo "<p class='card-text'>".$row['price']."</p>";
                        echo "<div class='d-flex  justify-content-evenly '>";
                        echo "<a href='product_details.php?id=".$row['id']."' class='btn btn-primary addCartBtn' style='width:110px; height:41px;'>View</a>";
                        echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'>";
                        echo "<input type='hidden' name='image' value='".$row['image']."'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<button type='submit' name='add' class='btn btn-success viewBtn' style='width:110px; height:41px;'>Add to Cart</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
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
            ob_end_flush();
    ?>

</body>
</html>