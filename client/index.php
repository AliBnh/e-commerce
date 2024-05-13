<?php
require_once "./templates/navbar.php";
require_once "../includes/db_connect.php";
$sql = "SELECT * FROM categories where archived = 0";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
  /* background: url(../uploads/bg3.jpg); */
  background-color: #f5f5f5;
  background-size: cover;
  background-position: center;
}
.banner-text{
    margin-right: 200px;
}
.cards{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;

}
.card{
    height: 300px;
    margin: 0 10px;
}
.card-img-top{
    height: 200px;
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
        <h2 style="margin-bottom: 32px;">Our Brands</h2>
        <div class="container">
            <div class="row cards">
        <?php foreach ($categories as $category) : ?>
            <div class="card" style="width: 18rem;">
                <img src="../uploads/<?= $category['image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $category['name'] ?></h5>
                    <a href="products.php?id=<?= $category['id'] ?>" class="btn btn-primary">View Products</a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    </div>
        
</body>
</html>
