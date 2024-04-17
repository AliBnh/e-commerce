<?php
require_once '../templates/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Edit Category</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back to home</a>
            </div>
        </header>
        <?php
            include("../../includes/db_connect.php");
            if(isset($_GET)){
                $id= mysqli_real_escape_string($conn, $_GET['id']);
                $sql = "SELECT * FROM categories WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
        ?> 
        <form action="process.php" method="post">
            <div class="form-element my-4">
                <input type="text" name="name" class="form-control" placeholder="Category Name " value="<?php echo $row["name"];?>" required>
            </div>
            <div class="form-element my-4">
                <input type="text" value="<?php echo $row["description"];?>" name="categoryDescription" class="form-control" placeholder="Category Description ">
            </div>
            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
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