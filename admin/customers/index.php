<?php
require_once '../templates/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1 class="text-center my-4">Customers List</h1>
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
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
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
        $sql = "SELECT * FROM users WHERE is_admin=0 AND archived=0";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['username']."</td>";
                            echo "<td>".$row['email']."</td>";
                            echo "<td>".$row['address']."</td>";
                            echo "<td>".$row['phone_number']."</td>";
                            echo "<td>";
                            echo "<a href='view.php?id=".$row['id']."' class='btn btn-primary mx-1'>Read More</a>";
                            echo "<a href='edit.php?id=".$row['id']."' class='btn btn-warning mx-1'>Edit</a>";
                            echo "<a href='delete.php?id=".$row['id']."' class='btn btn-danger mx-1'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td colspan='6'>No Customers were found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <a href="../logout.php" class="btn btn-warning ">Logout</a>

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