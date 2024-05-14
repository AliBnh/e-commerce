<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body{
            background-color: #f8f9fa;
        }
        .icon {
            width: 16px;
        }
        .table-container {
            margin: auto;
            max-width: 50%;
        }
        td, th{
            width: 30%;
            text-align: center;
        }
    .table{
        text-align: center;
        vertical-align: middle; 
        background-color: white;
    }
    </style>
</head>
<body>


<div class="container">
    <header class="d-flex justify-content-evenly mx-4">
        <h1 class="text-center">Brands List</h1>
        <div>
            <a href="create.php" class="btn btn-primary my-5 mx-2">Add a new Brand</a>
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
    <div class="table-container">
    <table class="table " style="border-radius: 16px;">
            <thead>
                <tr>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                require_once "../../includes/db_connect.php";
                $sql = "SELECT * FROM categories WHERE archived = 0";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td><img src='../../uploads/".$row['image']."' width='100' height='100'></td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td class='action-column'>"; 
                        echo "<div class='btn-group'>";
                        echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>";
                        echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning'><i class='fa fa-pencil-square-o icon'></i></a>";
                        echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>";
                        echo "</div>"; 
                        echo "</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='6'>No Categories were found</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
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