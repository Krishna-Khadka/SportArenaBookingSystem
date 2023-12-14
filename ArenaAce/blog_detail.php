<?php 
    session_start();
    session_regenerate_id(true); 
    // if(!isset($_SESSION['LoginId'])){
    //     header("location: login.php");
    // }
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
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- banner section starts -->

    <section id="banner" style="background: linear-gradient(#000C,#000C),url(assets/images/contactbg.jpg);">
        <div class="container">
            <div class="banner-field text-center">
                <h1>Blogs</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="contact.php">Blogs</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- blog-content section starts -->

    <section id="blog-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    
                </div>
                <div class="col-lg-4 blog-left">
                    <div class="blog-head">
                        <h5>recent article</h5>
                    </div>
                    <div class="blog-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="recent-blog d-flex align-items-center">
                                    <div class="images">
                                        <img src="assets/images/blog1.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="blog-heading">
                                        <a href="blog_detail.php"><h3>Highly Equiped Arena</h3></a>
                                    </div>
                                </div>
                                <div class="recent-blog d-flex align-items-center">
                                    <div class="images">
                                        <img src="assets/images/blog2.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="blog-heading">
                                        <a href="blog_detail.php"><h3>Highly Equiped Arena</h3></a>
                                    </div>
                                </div>
                                <div class="recent-blog d-flex align-items-center">
                                    <div class="images">
                                        <img src="assets/images/blog3.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="blog-heading">
                                        <a href="blog_detail.php"><h3>Highly Equiped Arena</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- blog-content section ends -->














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