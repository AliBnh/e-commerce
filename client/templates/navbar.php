<?php
    session_start();
    if(isset($_SESSION['user'])){
        $logged = true;
    }else{
        $logged = false;
    }
    require_once ".././includes/db_connect.php";
    $sql = "SELECT * FROM categories WHERE archived=0";
    $result = mysqli_query($conn, $sql);
    while($category = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $categories[] = $category;
    }
    if(isset($_GET['idCategoryNav'])){
        $id = $_GET['idCategoryNav'];
        header("Location: products.php?id=$id");
    }        
?>
<head>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+H2Xk4z3+OzK72RG8saOTqz0VewLDWuvfIspiRN1bq6Yg8Xn2OJqgxw1xH" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mx-5" href="index.php">BrandHub</a>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <form action="" method="get">
            <select name="idCategoryNav" onchange="this.form.submit()">
                    <option value="">Categories</option>
                    <?php
                        foreach($categories as $category){
                            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                        }
                    ?>
                </select>
            </form>        
            </li>
        </ul>
    </div>
    <a href="cart.php" class="nav-link mx-1">
        Cart
    </a>
    <?php
        if($logged){
            echo '<a href="profile.php" class="nav-link mx-1">Profile</a>';
            echo '<a href="orders.php" class="nav-link mx-1">Orders</a>';
            echo '<a href="auth/logout.php" class="btn btn-warning mx-2">Logout</a>';
        }else{
            echo '<a href="auth/login.php" class="btn btn-success mx-1">Login</a>';
            echo '<a href="auth/register.php" class="btn btn-success mx-1">Register</a>';
        }
    ?>

<form class="form-inline my-2 mx-5 d-flex" action="products.php" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Product name" aria-label="Search" name="name">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>

      