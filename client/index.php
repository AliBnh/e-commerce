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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
  background: url(../uploads/banner6.jpeg);
  background-size: cover;
  background-position: center;
  text-align: center;
}
.products {
  min-height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: url(../uploads/gradient.jpg);
  background-color: #f5f5f5;
  background-size: cover;
  background-position: center;
}
.banner-text{
    margin-bottom: 300px;
    text-align: center;


}
.cards{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    text-align: center;

}
.card{
    height: 310px;
    margin: 10px 10px;
}
.card-img-top{
    height: 200px;
    margin-top: 10px;
}
.btnView{
    background-color: #B7A4DB;
    color: white;
    font-weight: 500;
}
.btnView:hover{
    background-color: #D5CCEB;
    color: black;
}
*{
    font-family: 'Poppins', sans-serif;
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
                    <a href="products.php?id=<?= $category['id'] ?>" class="btn btnView">View Products</a>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    </div>
        
</body>
</html>
