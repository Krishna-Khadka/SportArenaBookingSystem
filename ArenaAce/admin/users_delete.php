<?php
include './authorization.php';
    require ('config.php');

    $userId = $_GET['id'];
    $sql = "DELETE FROM customers WHERE c_id = '{$userId}'";

    if(mysqli_query($con,$sql)){
        echo '<script>alert "user removed successfully";</script>';
        header("Location:users.php");
    }else{
        echo '<script>alert "user removed failed";</script>';
    }
    mysqli_close($con);
?>