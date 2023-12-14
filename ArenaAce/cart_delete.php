<?php
include "config.php";
if(isset($_GET['id'])){
    $cartid = $_GET['id'];
    $delete = "delete from court_cart where id=$cartid";
    if(mysqli_query($con,$delete)){
       // echo "deleted";
        $referer = $_SERVER['HTTP_REFERER']; 

header("Location: $referer");
    }else{
        echo "failed";
    }
}
?>