<?php 
    session_start();
    session_regenerate_id(true); 
    // if(!isset($_SESSION['LoginId'])){
    //     header("location: login.php");
    // }

    // if(isset($_SESSION['USER'])){
    //     print_r($_SESSION['USER']);
    // }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/swiper-bundle.min.css"> -->
    <link rel="stylesheet" href="assets/css/splide.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- hero section starts -->
    <section id="hero-text" style="background: url(assets/images/hero.png);">
        <div class="container">
            <div class="row" style="flex-direction: column;justify-content: center;height: 100vh;">
                <div class="col-lg-6 hero">
                    <h1>Book Your Sports Arena <span>Hassle-Free</span></h1>
                    <!-- <h1> 
                        <?php echo  $_SESSION['username']; ?>
                    </h1> -->
                    <p>Find and book your perfect sports arena hassle-free with our online booking system. Reserve a
                        court or
                        pitch with just a few clicks and be ready to play in no time, anytime and anywhere.</p>
                    <a href="#" class="btn"> <span></span>Find Arena</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- hero section ends -->

    <!-- card section starts -->
    <section id="card">
        <div class="row g-0">
            <div class="col-lg-4  col-sm-12">
                <div class="sport-card card1">
                    <h3>Tennis Court</h3>
                    <h4>01</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, praesentium?</p>
                    <a href="#" class="btn">Find Arena
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4  col-sm-12">
                <div class="sport-card card2">
                    <h3>Futsal Field</h3>
                    <h4>02</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, praesentium?</p>
                    <a href="#" class="btn">Find Arena
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-4  col-sm-12">
                <div class="sport-card card3">
                    <h3>Badminton Court</h3>
                    <h4>03</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi, praesentium?</p>
                    <a href="#" class="btn">Find Arena
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- card section ends -->

    <!-- service section starts -->

    <section id="service">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                    <img src="assets/images/service.png" class="img-fluid" alt="service_img">
                </div>
                <div class="col-lg-6 service-content">
                    <h2 class="heading">Unleash Your Inner Athlete with Our Convenient Online Booking System</h2>
                    <p>Whether you're an amateur or a professional, we offer a convenient online booking system that
                        allows you to
                        reserve your preferred sports arena with just a few clicks. Our platform is designed to simplify
                        the booking
                        process and provide you with a seamless experience. No more waiting on hold or searching through
                        different
                        websites. With us, you can find and book the perfect sports facility at any time and from
                        anywhere. Unleash
                        your inner athlete and join us today!</p>
                    <div class="service-list">
                        <ul>
                            <li class="d-flex">
                                <div class="icons">
                                    <i class="fa-solid fa-bullseye"></i>
                                </div>
                                <div class="service-det">
                                    <h2>Reach further</h2>
                                    <p>Push your limits and explore new sports arenas with our easy-to-use online
                                        booking system. Reach
                                        further and discover new horizons of sports.</p>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="icons">
                                    <i class="fa-solid fa-award"></i>
                                </div>
                                <div class="service-det det2">
                                    <h2>Best Quality</h2>
                                    <p>Experience unmatched quality with top-notch sports facilities and services, all
                                        accessible with
                                        just a few clicks.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- service section ends -->

    <!-- counter section starts -->
    <section id="counter" style="background: linear-gradient(#000B,#000B),url(assets/images/counterbg.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="heading">Revolutionizing Sports Booking</h2>
                    <p> Our online platform has transformed the way people book sports facilities, making it easier and
                        more
                        convenient than ever.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-box text-center">
                    <h2 class="counter">1000</h2>
                    <h6 class="text-capitalize">Sports Facilities</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-box text-center">
                    <h2 class="counter">10000</h2>
                    <h6 class="text-capitalize">successful bookings</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-box text-center">
                    <h2 class="counter">5000</h2>
                    <h6 class="text-capitalize">satisfied customers</h6>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-box text-center">
                    <h2 class="counter">10</h2>
                    <h6 class="text-capitalize">sports available</h6>
                </div>
            </div>
        </div>
    </section>
    <!-- counter section starts -->

    <!-- review section starts -->
    <section id="review">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 rTitle">
                    <h6>testimonials</h6>
                    <h2>our customer say</h2>
                </div>
                <div class="col-lg-7">
                    <div class="splide" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex">
                                            <p class="author">Krishna Khadka</p>
                                            <p class="location">Khorsane</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex">
                                            <p class="author">Sandhya Giri</p>
                                            <p class="location">lalbhitti</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex">
                                            <p class="author">Rahul Shah</p>
                                            <p class="location">Duhabi</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- review section ends -->


    <!-- blog section starts -->

    <section id="blog">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="title">
                        <h6 class="sub-heading">our blog</h6>
                        <h2 class="heading">latest news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="images">
                            <img src="assets/images/blog1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="blog-content">
                            <h3>Highly Equiped Arena</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse doloremque sunt id, unde at
                                corporis
                                cumque fuga itaque nisi porro.</p>
                            <a href="#">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="images">
                            <img src="assets/images/blog2.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="blog-content">
                            <h3>Highly Equiped Arena</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse doloremque sunt id, unde at
                                corporis
                                cumque fuga itaque nisi porro.</p>
                            <a href="#">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="blog-card">
                        <div class="images">
                            <img src="assets/images/blog3.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="blog-content">
                            <h3>Highly Equiped Arena</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse doloremque sunt id, unde at
                                corporis
                                cumque fuga itaque nisi porro.</p>
                            <a href="#">Read More <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- blog section ends -->

    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/jqueyv1/jquery.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="assets/js/swiper-bundle.min.js"></script> -->
    <script src="assets/js/splide.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <!-- <script src="assets/js/jquery-ui.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script>
        $('.counter').counterUp({
            delay: 10,
            time: 1600
        });
    </script>
    <!-- <script>
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',
            slidesPerView: 3,
            loop:true,
            autoplay: 'true',
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            },
        });
    </script> -->
    <script>
        var splide = new Splide('.splide', {
            direction: 'ttb',
            height: '10rem',
            type: 'loop',
            arrows: false,
            autoplay: 'true',
        });

        splide.mount();
    </script>
    
    <script>
    $(document).ready(function() {
        $('#search_arena').keyup(function() {
        var query = $(this).val();
        //alert("hello");
        $.ajax({
            url: './fetch_service.php',
            method: 'GET',
            data: { query: query },
            dataType: 'json',
            success: function(data) {
            $('#search_arena').autocomplete({
                source: data
                // select: function(event, ui) {
                // // Redirect to the desired page when a result is clicked
                // window.location.href = 'shop_details/shop=' + ui.item.value;
                // }
            

            });
            }
        });
        });
    });
    </script>
</body>

</html>