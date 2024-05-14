<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>
<?php
if(isset($_POST['sort'])){
    $category = $_POST['category'];
    if($category == 0){
        header("Location: index.php");
    }else{
        header("Location: index.php?category=".$category);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
</style>
<body>
<div class="container">
<header class="d-flex justify-content-between ">
            <h1 class="text-center my-4">Products List</h1>
            <div>
                <a href="create.php" class="btn btn-primary  my-5 mx-2">Add a new Product</a>
            </div>
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
        <div class="d-flex mb-2 justify-content-evenly">
        <form action="" method="post">
            <div class="d-flex ">
            <div class="form-element">
                <select name="category" class="form-control" style="width: 220px;border-top-right-radius: 0px; border-bottom-right-radius:0px">
                    <option value="0">All Brands</option>
                    <?php
                        require_once "../../includes/db_connect.php";
                        $sql = "SELECT * FROM categories WHERE archived = 0";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<option value='".$row['id']."'>".$row['name']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-element" style="width: 20px;" >
                <input type="submit" class="btn btn-success" style="width: 80px; border-top-left-radius: 0px; border-bottom-left-radius:0px" name="sort" value="Filter">
            </div>
            </div>
        </form>
        <form action="" method="get">
             <div class="d-flex ">
                <input type="text" name="searchTerm" class="form-control" style="width: 220px;border-top-right-radius: 0px; border-bottom-right-radius:0px; " placeholder="search term">
                <button type="submit" class="btn btn-primary" style="width: 80px; border-top-left-radius: 0px; border-bottom-left-radius:0px">Search</button>
            </div>
        </form>
        </div>
        <br>
        <table class="table " style="border-radius: 16px;">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Name</th>
                    <th>Selling Price</th>
                    <th>Costing Price</th>
                    <th>Ram</th>
                    <th>Storage</th>
                    <th>Brand</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            if(isset($_GET['searchTerm'])) {
                $searchTerm = $_GET['searchTerm'];
                require_once "../../includes/db_connect.php";
                $sql = "SELECT * FROM products WHERE archived = 0 AND name LIKE '%$searchTerm%' OR price LIKE '%$searchTerm%' OR cost_price LIKE '%$searchTerm%' OR ram LIKE '%$searchTerm%' OR storage LIKE '%$searchTerm%' OR category_id LIKE '%$searchTerm%'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td><img src='../../uploads/".$row['image']."' width='100' height='100'></td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['price']."</td>";
                        echo "<td>".$row['cost_price']."</td>";
                        echo "<td>".$row['ram']."</td>";
                        echo "<td>".$row['storage']."</td>";
                        $categoryId = $row['category_id'];
                        $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                        $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                        $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                        echo "<td>".$categoryNameRow['name']."</td>";
                        echo "<td>";
                        echo "<div class='btn-group'>";
                        echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>";
                        echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning'><i class='fa fa-pencil-square-o icon'></i></a>";
                        echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>";
                        echo "</div>";     
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No Products were found</td></tr>";
                }
            } elseif (!isset($_GET['category'])) {
                ?>
               <?php
        require_once "../../includes/db_connect.php";
        $sql = "SELECT * FROM products WHERE archived = 0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td><img src='../../uploads/".$row['image']."' width='100' height='100'></td>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['price']."</td>";
                            echo "<td>".$row['cost_price']."</td>";
                            echo "<td>".$row['ram']."</td>";
                            echo "<td>".$row['storage']."</td>";
                            $categoryId = $row['category_id'];
                            $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                            $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                            $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                            echo "<td>".$categoryNameRow['name']."</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>";
                            echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning'><i class='fa fa-pencil-square-o icon'></i></a>";
                            echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>";
                            echo "</div>";     
                            echo "</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='8'>No Products were found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
            }else{
                    $category = $_GET['category'];
                    require_once "../../includes/db_connect.php";
                    $sql = "SELECT * FROM products WHERE category_id = $category AND archived = 0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td><img src='../../uploads/".$row['image']."' width='100' height='100'></td>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['price']."</td>";
                            echo "<td>".$row['cost_price']."</td>";
                            echo "<td>".$row['ram']."</td>";
                            echo "<td>".$row['storage']."</td>";
                            $categoryId = $row['category_id'];
                            $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                            $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                            $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                            echo "<td>".$categoryNameRow['name']."</td>";
                            echo "<td>";
                            echo "<div class='btn-group'>";
                            echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>";
                            echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning'><i class='fa fa-pencil-square-o icon'></i></a>";
                            echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>";
                            echo "</div>"; 
                            echo "</td>";
                            
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='8'>No Products were found</td></tr>";
                    }            
            }?>
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
