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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>
#idCategoryNav{
        width:100%;
        border: 0px solid gainsboro;
        margin-top: 9px;
        background-color: transparent;
        margin-left: 10px;
}
.icon{
    font-size: 1.5rem;
}
.icon:hover{
    color: grey;
}
</style>

<nav class="navbar navbar-expand-lg bg-white ">
    <a class="navbar-brand mx-5" href="index.php">
        <i class="fa fa-mobile icon mx-2" aria-hidden="true"></i><strong>BrandHub</strong> 
    </a>

    <div class="collapse navbar-collapse mx-4" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php"  style="color:black;"><i class="fa fa-home icon" aria-hidden="true"></i>
</a>
            </li>
            <li class="nav-item">
            <form action="" method="get">
            <select name="idCategoryNav" onchange="this.form.submit()" id='idCategoryNav'>
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

    <form class="form-inline my-2 mx-4 d-flex" action="products.php" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Product name" aria-label="Search" name="name">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
    </form>

    <a href="cart.php" class="nav-link mx-1">
    <i class="fa fa-shopping-cart icon" aria-hidden="true"></i>
    </a>
    <?php
        if($logged){
            echo '<a href="profile.php" class="nav-link mx-2"><i class="bi bi-person-fill icon"></i></a>';
            echo '<a href="orders.php" class="nav-link mx-2"><i class="fa fa-history icon" aria-hidden="true"></i>
            </a>';
            echo '<div class=" mx-5">';
            echo '<a href="auth/logout.php" class="btn btn-warning mx-2 px-2"><i class="fa fa-sign-out icon" aria-hidden="true"></i></a>';
            echo '</div>';
        }else{
            echo '<div class=" mx-5">';
            echo '<a href="auth/login.php" class="btn btn-success mx-1">Login</a>';
            echo '<a href="auth/registration.php" class="btn btn-success mx-1">Register</a>';
            echo '</div>';
        }
    ?>
</nav>

      