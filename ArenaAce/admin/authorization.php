<?php
session_start();
session_regenerate_id(true);

if(!isset($_SESSION['user_role']) && $_SESSION['user_role']!='admin'){
    header('location:login.php');
    die();
}

?>