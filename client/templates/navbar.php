<?php
session_start();

echo "
<head>
<link rel='stylesheet' href='styles.css'>
</head>
<style>
//make items centered vertically


</style>
<nav class='navbar navbar-expand-sm navbar-light bg-light '>
    <div class='container-fluid mx-5 all'>
        <a class='navbar-brand' href='index.php'>BrandHub</a>
        <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse justify-content-between  align-items-center' id='navbarNav'>
            <ul class='navbar-nav ' id='navul'>
                <li class='nav-item'>
                    <a class='nav-link active' aria-current='page' href='index.php'>Home</a>
                </li>";
if(isset($_SESSION['user'])){
    echo "<li class='nav-item'>
                    <a class='nav-link' href='profile.php'>Profile</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='orders.php'>Orders</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='auth/logout.php'>Logout</a>
                </li>";
}
else{
   echo "<li class='nav-item'>
                    <a class='nav-link' href='auth/login.php'>Login</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='auth/registration.php'>Register</a>
                </li>";
}
echo"           <li class='nav-item'>
                    <a class='nav-link' href='cart.php'>Cart</a>
                </li>
            </ul>
            <div class='search'>
            <form class='d-flex ' action='products.php' method='get'>
                <input class='form-control me-2' type='search' placeholder='Search' aria-label='Search' name='name'>
                <button class='btn btn-outline-success' type='submit'>Search</button>
            </form>
            </div>
        </div>
    </nav>";
require_once "../includes/db_connect.php";

?>