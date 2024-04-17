<?php
if(isset($_GET['id'])){
    include("../../includes/db_connect.php");
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM users WHERE id=$id";
    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION['delete'] = "The User has been deleted successfully!";
        header("Location: index.php");
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>