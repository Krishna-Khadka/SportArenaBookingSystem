<?php
session_start();
session_regenerate_id(true);
// if(!isset($_SESSION['LoginId'])){
//     header("location: login.php");
// }
?>

<?php

include "config.php";
$sql = "SELECT image FROM slider_images";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $images = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $images = [];
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
          body {
            background-color: #f4e9d7; 
        }

        .gallery-container {
            column-count: 2; 
            column-gap: 16px;
            margin: 0 auto; 
            max-width: 1470px; 
        }

        .gallery-item {
            break-inside: avoid-column; 
            margin-bottom: 16px; 
            overflow: hidden;
            position: relative;
        }

        .gallery-img {
            display: block;
            max-width: 100%;
            min-height: 400px;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.05);
        }
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
                <h1>Contact Us</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- gallery section starts -->

    <section id="gallery">
    <div class="container mt-5">
        <div class="gallery-container">
            <?php
            $directory = 'admin/assets/slider/';
            $images = glob($directory . "*.{jpg,png,gif}", GLOB_BRACE);

            foreach($images as $image):
            ?>
                <div class="gallery-item">
                    <img src="<?php echo $image; ?>" alt="Image" class="gallery-img">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </section>

    <!-- gallery section ends -->


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