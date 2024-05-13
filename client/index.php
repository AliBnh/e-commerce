<?php
require_once "./templates/navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  list-style: none;
  border: none;
  outline: none;
  font-family: "Poppins", sans-serif;
}
.banner {
  min-height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: url(../uploads/white-robot-vacuum-smartphone-home-electronics.jpg);
  background-size: cover;
  background-position: center;
}
.products {
  min-height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: url(../uploads/bg3.jpg);
  background-size: cover;
  background-position: center;
}
.banner-text{
    margin-right: 200px;
}
</style>
<body>
<div class="banner">
    <div  class="banner-text">
    <h1>Welcome to BrandHub</h1>
            <p>Find the best phones at the best prices</p>
            <p>Start shopping now</p>
    </div>

        </div>
       
    <div class="products">
    <h2>Products</h2>
        <h2>Categories</h2>
        <div class="container">
        <div class="row">
            <?php
                $sql = "SELECT * FROM categories WHERE archived=0";
                $result = mysqli_query($conn,$sql);
                while($category = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<div class='col-md-3'>";
                    echo "<a href='products.php?id=".$category['id']."'>";
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>".$category['name']."</h5>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

        

</body>
</html>
