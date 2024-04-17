<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: ../login.php");
    }
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
            <h1 class="text-center my-4">Edit Product</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <?php
            include("../../includes/db_connect.php");
            if(isset($_GET)){
                $id= mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT * FROM products WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $image =  $row['image'];
        ?> 
        <form action="process.php" method="post" enctype="multipart/form-data">

            <div class="form-element my-4">
                <input type="text" name="name" class="form-control" placeholder="Product Name "  value="<?php echo $row["name"];?>" required>
            </div>
            <div class="form-element my-4">
                <input type="text" name="description" value="<?php echo $row["description"];?>" class="form-control" placeholder="Product Description ">
            </div>
            <div class="form-element my-4">
                <input type="number" name="price" value="<?php echo $row["price"];?>" class="form-control" placeholder="Product Price " required>
            </div>
            <select name="categoryId"  class="form-element my-4" required>
                <?php
                    require_once "../../includes/db_connect.php";
                    $sql = "SELECT * FROM categories WHERE archived = 0";
                    $result = mysqli_query($conn, $sql);
                    $categoryId =$row["category_id"];
                    $fetchCategoryNameSql = "SELECT name FROM categories WHERE id=$categoryId";
                    $categoryNameRows = mysqli_query($conn, $fetchCategoryNameSql);
                    $categoryNameRow = mysqli_fetch_assoc($categoryNameRows);
                    $categoryName = $categoryNameRow['name'];
                    echo "<option value='$categoryId'>$categoryName</option>";

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            if($row['id'] != $categoryId)
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }
                    }
                ?>
            </select>


            <div class="form-element my-4">
                <input type="file" name="image" class="form-control" >
            <?php if (isset($image)) : ?>
                <p>Current Image: <?php echo $image; ?></p>
                <input type="hidden" name="image" value="<?php echo $image; ?>">
            <?php endif; ?>
            </div>
            <img src="../../uploads/<?php echo $image ?>" width="100" height="100">


            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            <div class="form-element">
                <input type="submit" class="btn btn-success" name="edit" value="Save">
            </div>
        </form>
        <?php
            }
        ?>
        <a href="../logout.php" class="btn btn-warning ">Logout</a>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>