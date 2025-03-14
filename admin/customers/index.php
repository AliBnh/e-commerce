<?php
require_once '../templates/header.php';
require_once '../templates/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    .heading{
        position: absolute;
        top: 50px;
        left: 50%;            
    }

</style>
<body>
<div class="container">
<header class="">
    <h1 class="text-center heading">Customers List</h1>
    <div class="d-flex justify-content-end">
        <a href="create.php" class="btn btn-primary  my-3">Add a new user</a>
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
        <form action="" method="get">
             <div class="d-flex ">
                <input type="text" name="searchTerm" class="form-control" style="width: 220px;border-top-right-radius: 0px; border-bottom-right-radius:0px; " placeholder="search term">
                <button type="submit" class="btn btn-primary" style="width: 80px; border-top-left-radius: 0px; border-bottom-left-radius:0px">Search</button>
            </div>
        </form>
        <table class="table " style="border-radius: 16px;">
            <thead>
                <tr>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               <?php
            require_once "../../includes/db_connect.php";

               if(isset($_GET['searchTerm']) && !empty($_GET['searchTerm'])){
                   $searchTerm = $_GET['searchTerm'];
                   $sql = "SELECT * FROM users WHERE is_admin=0 AND archived=0 AND (username LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR address LIKE '%$searchTerm%' OR phone_number LIKE '%$searchTerm%')";
                   $result = mysqli_query($conn, $sql);
                   if(mysqli_num_rows($result) > 0){
                       while($row = mysqli_fetch_assoc($result)){
                           echo "<tr>";
                           echo "<td>".$row['username']."</td>";
                           echo "<td>".$row['email']."</td>";
                           echo "<td>".$row['address']."</td>";
                           echo "<td>".$row['phone_number']."</td>";
                           echo "<td>";
                           echo "<div class='btn-group'>";
                           echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary'><i class='fa fa-info icon'></i></a>";
                            echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning'><i class='fa fa-pencil-square-o icon'></i></a>";
                            echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger'><i class='fa fa-trash-o icon'></i></a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }}else{
                            echo "<tr><td colspan='6'>No Customers were found</td></tr>";
                        }
                    


               }else{
                $sql = "SELECT * FROM users WHERE is_admin=0 AND archived=0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['address']."</td>";
                            echo "<td>".$row['phone_number']."</td>";
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
                        echo "<tr><td colspan='6'>No Customers were found</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

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