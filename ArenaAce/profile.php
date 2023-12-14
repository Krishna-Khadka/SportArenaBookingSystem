<?php
session_start();
session_regenerate_id(true);
// if(!isset($_SESSION['LoginId'])){
//     header("location: login.php");
// }
if(!isset($_SESSION['user_role']) && $_SESSION['user_role']!='client'){
    header('location:userLogin.php');
    die();
}

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$filename = basename(parse_url($url, PHP_URL_PATH));
// echo $filename; exit;
if($filename == 'confirm_booking.php'){
    require "email_confirm.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arenas | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>

    </style>
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- banner section starts -->

    <section id="banner" style="background: linear-gradient(#000C,#000C),url(assets/images/contactbg.jpg);">
        <div class="container">
            <div class="banner-field text-center">
                <h1>My Profile</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="arena.php">My Profile</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- wrapper section starts -->

    <section id="wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="wrapper-body mt-5 mb-5">
                        <div class="wrapper-top text-center">
                            <h3>Booking History</h3>
                            <p>Enter Your Email to Confirm Your Booking</p>
                        </div>
                        <div class="wrapper-bottom">
                            <form action="#" method="post" class="row g-3">
                                <div class="col-12 mb-3">
                                    <label for="yourPhone" class="form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" id="yourPhone" required>
                                </div>
                                <button class="btn btn-primary w-100" type="submit" name="confirm_booking">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>

    <!-- wrapper section ends -->






    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>