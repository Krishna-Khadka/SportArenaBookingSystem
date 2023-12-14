<?php 
include './authorization.php';
require('config.php');

   if(isset($_POST['delete_arena_btn'])){
        $arena_id = $_POST['$arena_id'];
        $sql = "DELETE FROM arena where a_id = '$arena_id";

        if(mysqli_query($con,$sql)){
            header("location: arena.php");
        }
        else{
            echo"<script>alert('Arena Removal Failed');</script>";
        }
        mysqli_close($con);
   }


?>