<?php
    session_start();
    if(isset($_SESSION['user'])){
        echo "<h2>Welcome ".$_SESSION['username']."</h2>";
        echo "<a href='./auth/logout.php' class='btn btn-warning'>Logout</a>";
        echo "<a href='./profile.php' class='btn btn-info'>Profile</a>";
    }else{ 
        echo "<h2>Welcome Guest</h2>";
        echo "<a href='./auth/login.php' class='btn btn-primary'>Login</a>";
        echo "<a href='./auth/registration.php' class='btn btn-success'>Register</a>";
    }
    echo "<a href='./index.php' class='btn btn-warning'>Home</a>";
    echo "<a href='./cart.php' class='btn btn-info'>Cart</a>";
    require_once "../includes/db_connect.php";
?>
