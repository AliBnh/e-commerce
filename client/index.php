<?php
require_once "header.php";
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
    <div class="container">
        <h2>Categories</h2>
        <div class="row">
            <?php
                $sql = "SELECT * FROM categories";
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
            <form action="products.php" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Search by name">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

        

</body>
</html>
