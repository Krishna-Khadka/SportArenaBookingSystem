<?php
session_start();
session_regenerate_id(true);
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$filename = basename(parse_url($url, PHP_URL_PATH));
require('config.php');
// if(!isset($_SESSION['LoginId'])){
//     header("location: home.php");
// }
if (isset($_SESSION['USER'])) {
    //print_r($_SESSION['USER']);
    $user_id = $_SESSION['USER']['id'];
    $user_name = $_SESSION['USER']['fullname'];
    $user_email = $_SESSION['USER']['email'];
    $user_address = $_SESSION['USER']['address'];
    //echo $user_id;
}
if($filename == 'single_arena_detail.php'){
    require "book_process.php";
}
?>

<?php
$arena_id = $_GET['arena_id'];
if(isset($_GET['delete_id'])) {
    $delete = $_GET['delete_id'];
    //echo $delete;
    $sqlDelete = "delete from court_cart where id = '$delete'";
    $result = mysqli_query($con, $sqlDelete) or die("Query failed");
    // header("Location: single_arena_detail.php?arena_id='$arena_id'");
}
//echo $id;
include "config.php";
$sql1 = "SELECT * FROM arena where a_id = '$arena_id'";
$result = mysqli_query($con, $sql1) or die("Query failed");

if (mysqli_num_rows($result) > 0)
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($result); exit;
        $id = $row['a_id'];
        $name = $row['name'];
        $address = $row['address'];
        $image = $row['thumbnail'];
        $description = $row['description'];
        $thumbnail = $row['thumbnail'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    }



    if (isset($_POST['search_time'])) {
        $date = $_POST['date'];
        $court = $_POST['court'];


        $_SESSION['DATE'] = $date;
        $_SESSION['COURT'] = $court;


        //echo $date,$court; exit;

        // $sql = "SELECT courts.name,time_slots.time,time_slots.isBooked FROM `courts` inner join time_slots on (courts.court_id = time_slots.court_id) where courts.court_id = '$court' and time_slots.date = '$date'";
        $sql = "SELECT time_slots.time, courts.name, CASE WHEN isBooked = 1 THEN 1 ELSE 0 END as isBooked
        FROM time_slots
        INNER JOIN courts ON (time_slots.court_id = courts.court_id)
        WHERE time_slots.court_id = $court and date = '$date'";
        $results = mysqli_query($con, $sql); 
    
    }


    if(isset($_POST['add_cart'])){
        $time_slot = $_POST['timeslot'][0];
        $date = $_SESSION['DATE'];
        $court = $_SESSION['COURT'];
        //echo $date,$court;

        $sql = "insert into court_cart(`user_id`, `court_id`, `date`, `time`) VALUES ('$user_id','$court','$date','$time_slot')";
        $cart_results = mysqli_query($con, $sql); 
    }

$sql = "select arena.name as arena,sport.name as sport,courts.court_id,courts.name,courts.price,courts.discount as court_name from arena inner join assign_court on (arena.a_id = assign_court.arena_id) inner join  sport on (sport.s_id = assign_court.sport_id ) inner join courts on (courts.court_id = assign_court.court_id) where arena.a_id = '$arena_id'";
$result = mysqli_query($con, $sql) or die("Query failed");


$sqlCourtCart = "select court_cart.id,court_cart.time,court_cart.date,courts.name as court ,courts.price,courts.discount,user.fullname from courts 
inner join court_cart on (court_cart.court_id = courts.court_id) inner join user on (user.id = court_cart.user_id) where court_cart.user_id = '$user_id'";
$resultCart = mysqli_query($con,$sqlCourtCart) or die("Query failed");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arenas | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/splide.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet-fullscreen@1.5.1/dist/leaflet.fullscreen.css" /> -->
    <link rel="stylesheet" href="assets/css/jquery.fancybox.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- banner section starts -->

    <section id="arena_banner" style="background:url(admin/assets/upload/<?= $image ?>);">
        <div class="container">
            <div class="banner-field">
                <h1>
                    <?= $name; ?>
                </h1>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <section id="single_arena_detail">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-8">
                    <!-- arena-nav section starts -->
                    <section id="arena-nav">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <ul class="d-flex justify-content-between">
                                        <li><a href="#overview">Overview</a></li>
                                        <li><a href="#booking">Booking</a></li>
                                        <!-- <li><a href="#">Location</a></li>
                                        <li><a href="#">User Review</a></li> -->
                                    </ul>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- arena-nav section ends -->

                    <!--overview section starts -->

                    <section id="overview">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="overview-title text-center">About <span>
                                            <?= $name; ?>
                                        </span></h1>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Arena Description
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">
                                                <?= $description; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Choose Time
                                        </div>
                                        <div class="card-body">
                                            <form action="#" method="post">
                                                <div class="slot d-flex align-items-center justify-content-between">
                                                    <div class="slot-date">
                                                        <label for="">Search Date: </label>
                                                        <input type="date" name="date" value="<?php if(isset($_SESSION['DATE']) && isset($_POST['search_time'])) { echo $_SESSION['DATE'];  } ?>" >
                                                    </div>
                                                    <div class="slot-field">
                                                        <label for="">Select Field: </label>
                                                        <select name="court" id="">
                                                            <option value="">Select Court</option>
                                                            <?php

                                                            if (mysqli_num_rows($result) > 0) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $courts_id = $row['court_id'];
                                                                    $courts_name = $row['name'];
                                                            ?>
                                    <!-- <option value="<?php //echo $courts_id; ?>" 
                                    <?php //if(isset($_SESSION['COURT']) && ($courts_id == $_SESSION['COURT']) && isset($_POST['search_time'])){ echo "selected"; unset($_SESSION['COURT']); }?>>
                                        <?php //echo $courts_name; ?>
                                    </option> -->
                                    <option value="<?php echo $courts_id; ?>" 
                                    <?php if(isset($_SESSION['COURT']) && ($courts_id == $_SESSION['COURT']) && isset($_POST['search_time'])){ echo "selected";  }?>>
                                        <?php echo $courts_name; ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                                                            ?>
                                                            <!-- <option value="court">Court</option> -->
                                                        </select>
                                                    </div>
                                                    <!-- <div class="slot-time">
                            <label for="">Select Court: </label>
                            <select name="court" id="">
                                <option value="">Select Court</option>
                                <?php

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $courts_id = $row['court_id'];
                                        $courts_name = $row['name'];
                                ?>
                                        <option value="<?php echo $courts_id; ?>">
                                            <?php echo $courts_name; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                        ?>
                                ?>
                                 <option value="court">Court</option> -->
                                                    </select>
                                                </div>
                                        </div>
                                        <input type="submit" class=" form-control search-slot btn btn-primary" name="search_time" value="Search">
                                        </form>
                                    </div>
                                </div>
                                
                                <form action="#" method="post" class="mt-3">
                                    <?php
                                    if (isset($_POST['search_time'])) :
                                        // $date = $_POST['date'];
                                        // $court = $_POST['court'];


                                        // $_SESSION['DATE'] = $date;
                                        // $_SESSION['COURT'] = $court;


                                        // //echo $date,$court; exit;

                                        // // $sql = "SELECT courts.name,time_slots.time,time_slots.isBooked FROM `courts` inner join time_slots on (courts.court_id = time_slots.court_id) where courts.court_id = '$court' and time_slots.date = '$date'";
                                        // $sql = "SELECT time_slots.time, courts.name, CASE WHEN isBooked = 1 THEN 1 ELSE 0 END as isBooked
                                        // FROM time_slots
                                        // INNER JOIN courts ON (time_slots.court_id = courts.court_id)
                                        // WHERE time_slots.court_id = $court and date = '$date'";
                                        // $results = mysqli_query($con, $sql);

                                        $i = 1;
                                        foreach ($results as $res) :
                                            $i++;
                                            $Time_Slot =  $res['time'];
                                            $isBooked = $res['isBooked'];
                                            $statusLabel = $isBooked ? "Booked" : date("h:i A", strtotime($Time_Slot));
                                            $statusClass = $isBooked ? "btn btn-danger" : "btn btn-outline-primary";


                                    ?>
                                            <div>
                                                <input type="radio" name="timeslot[]" id="time<?= $i ?>" value="<?= $Time_Slot ?>" <?= $isBooked ? 'disabled' : '' ?>>
                                               
                                                <?= $time ?>
                                            
                                                <label for="time<?= $i ?>" class="btn btn-outline-primary <?= $statusClass ?>"><?php echo date("h:i A", strtotime($Time_Slot)); ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if(isset($_POST['search_time'])):?>
                                    <input type="submit" class=" form-control search-slot btn btn-primary" name="add_cart" value="Add Court to Cart">
                                    <?php endif;?>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>


                <!--overview section ends -->

                <div class="col-lg-4">

                    <!-- arena slider section starts -->

                    <!-- <section id="arena_slider">
                        <div class="card">
                            <h5 class="card-header">Arena Images</h5>
                            <div class="card-body">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/arena1.jpg" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/arena2.jpg" alt="">
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/arena3.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </section> -->
                    <section id="arena_slider">
                        <div class="card">
                            <h5 class="card-header">Arena Images</h5>
                            <div class="card-body">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="assets/images/arena1.jpg" data-fancybox="arena-gallery" data-caption="Arena 1">
                                                <img src="assets/images/arena1.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="assets/images/arena2.jpg" data-fancybox="arena-gallery" data-caption="Arena 2">
                                                <img src="assets/images/arena2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="assets/images/arena3.jpg" data-fancybox="arena-gallery" data-caption="Arena 3">
                                                <img src="assets/images/arena3.jpg" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <!-- arena slider section ends -->

                    <!-- cart section -->
                    <section id="arena_cart">
                        <div class="card">
                            <div class="card-header">
                                Cart
                            </div>
                            <div class="card-body">
                                <div class="row">
                                 <?php
                                  $total = 0;
                                  foreach($resultCart as $cart): 
                                    $total += $cart['price'];
                                   echo $cart['id'];
                                  ?>
                                 <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-content d-flex justify-content-between">
                                            <div class="card_left">
                                                <h2><?php echo $cart['court']; ?></h2> 
                                            </div>
                                            <div class="card_right">
                                                <a href="single_arena_detail.php?arena_id=<?=$arena_id?>&&delete_id=<?=$cart['id']?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card-content d-flex justify-content-between">
                                            <div class="card_left">
                                                <h2><?=$cart['date']?></h2>
                                            </div>
                                            <div class="card_right">
                                                Time: &nbsp;<?=$cart['time']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="card-content d-flex justify-content-between">
                                            <div class="card_left">
                                                <h2>RS. <?=$cart['price']?></h2>
                                            </div>
                                            <!-- <div class="card_right">
                                                <i class="fa fa-trash"></i>
                                            </div> -->
                                        </div>
                                    </div>

                                </div> <hr>
                                <?php endforeach;?>
                                <h3>Total: <?=$total?></h3>
                                <?php 
                                //   $book_id = $user_id.time();
                                 
                                
                                ?>
                                 <form action="" method="post">
                                    <!-- <input type="hidden" name="purchase_order_id" value="<?//=$book_id;?>">
                                    <input type="hidden" name="amount" value="<?=$total;?>">
                                    <input type="hidden" name="return_url" value=""> -->

                                    <!-- <input type="hidden" name="book_id" value="<?//=$book_id;?>"> -->
                                    <input type="hidden" name="arena_id" value="<?=$arena_id;?>">
                                    <input type="hidden" name="user_id" value="<?=$user_id?>">
                                    <!-- <input type="hidden" name="court_id" value="<?=$court_id?>">   -->
                                    <input type="hidden" name="court_cart_id" value="<?=$cart['id']?>"> 



                                     <input type="submit" class="btn btn-primary" value="Proceed To Pay">

                                     <input type="submit" class="btn btn-primary" name="manuel_book" value="Manuel Book">

                                 </form>

                                
                            </div>
                        </div>
                    </section>




                    <!-- arena location section starts -->

                    <section id="arena_map">
                        <div class="card">
                            <div class="card-header">
                                Location
                            </div>
                            <div class="card-body">
                                <div id="map" style="height:250px;"></div>
                            </div>
                        </div>
                    </section>

                    <!-- arena location section ends -->

                </div>

                <!-- booking section starts -->

                <section id="booking">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <h5 class="card-header">User Details</h5>
                                    <div class="card-body">
                                        <form action="#" class="mt-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" disabled placeholder="Your Full Name" value="<?= $user_name; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" placeholder="Your   Email" disabled value="<?= $user_email; ?>">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Your Address" disabled value="<?= $user_address; ?>">
                                                </div>
                                                <!-- <div class="col-md-6">
                                            <input type="date" class="form-control" placeholder="Select Date">
                                        </div> -->

                                                <!-- <div class="col-md-12">
                                            <select class="form-select" aria-label="Default select example">
                                                <option selected>Select Field</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <select class="form-select" name="court_id" aria-label="Select Court">
                                                <option selected>Select Court</option>
                                                <?php
                                                include "config.php";
                                                $sql2 = "select arena.name as arena,sport.name as sport,courts.court_id,courts.name,courts.price,courts.discount as court_name from arena inner join assign_court on (arena.a_id = assign_court.arena_id) inner join  sport on (sport.s_id = assign_court.sport_id ) inner join courts on (courts.court_id = assign_court.court_id) where arena.a_id = '$arena_id'";
                                                $result1 = mysqli_query($con, $sql2) or die("Query failed");
                                                if (mysqli_num_rows($result1) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result1)) {
                                                        $court_id = $row['court_id'];
                                                        $court_name = $row['name'];
                                                        $court_price = $row['price'];
                                                        $discount_price = $row['discount'];
                                                ?>
                                                        <option value="<?php echo $court_id; ?>">
                                                            <?php echo $court_name . " " . $court_price; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div> -->
                                                <!-- <button type="submit" class="btn btn-primary text-capitalize">book my
                                                    arena</button> -->
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- booking section ends -->

            </div>

        </div>
        <section id="arena_more">
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-12">
                        <h1>People who viewed this sports also viewed</h1>
                    </div> -->
                    <div class="col-lg-12">
                        <div class="card">
                            <h5 class="card-header">People who viewed this sports also viewed</h5>
                            <div class="card-body">
                                <!-- <h5 class="card-title">Special title treatment</h5> -->
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="arena-box">
                                            <div class="thumbnail">
                                                <img src="assets/images/arena1.jpg" class="img-fluid rounded-start" height="100px" width="100px" alt="">
                                                <div class="thumb-text">
                                                    <h6>Bookable</h6>
                                                </div>
                                            </div>
                                            <div class="arena-body">
                                                <div class="arena-name">
                                                    <h6>
                                                        Belbari Badminton Hall
                                                    </h6>
                                                </div>
                                                <p class="address">
                                                    Belbari-6, Morang
                                                </p>
                                                <a href="single_arena_detail.php?arena_id=<?= $arena_id ?>" class="btn">View
                                                    Details
                                                    <i class="fa-solid fa-arrow-right-long"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>



        <!-- contact-form section start -->

        <!-- <section id="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3565.8266758712894!2d87.27616107498987!3d26.654031371160247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef6c6a65cf563b%3A0xd198724cd1ca1441!2sItahari%20Stadium!5e0!3m2!1sen!2snp!4v1683869185371!5m2!1sen!2snp"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h2 class="heading">Leave a message</h2>
                            </div>
                        </div>
                        <form action="#" class="mt-3">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your FullName">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Address">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" placeholder="Your Number">
                                </div>
                                <div class="col-md-12">
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn">send a message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- contact-form section end -->





        <!-- Footer section starts -->

        <?php include "footer.php"; ?>

        <!-- Footer section ends -->





        <script src="assets/jqueyv1/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <!-- <script src="https://unpkg.com/leaflet-fullscreen@1.5.1/dist/Leaflet.fullscreen.js"></script> -->
        <script src="assets/js/jquery.fancybox.js"></script>
        <script src="assets/js/splide.min.js"></script>
        <script>
            window.addEventListener("scroll", function() {
                var nav = document.querySelector("nav");
                nav.classList.toggle("sticky", window.scrollY > 0);
            })
        </script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                cssMode: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                mousewheel: true,
                keyboard: true,
                autoplay: true,
                loop: true,
            });
            $('[data-fancybox="arena-gallery"]').fancybox({

            });
        </script>
        <!-- Initialize FancyBox -->
        <script>
            // JavaScript code for generating the map using Leaflet.js
            var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map)
                .bindPopup('<?= $name; ?>').openPopup();
        </script>
        
        <script>
            var locationId = 1; // Replace with the actual location ID you want to fetch
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_location.php?location_id=' + locationId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var locationData = JSON.parse(xhr.responseText);
                        var latitude = locationData.latitude;
                        var longitude = locationData.longitude;

                        var map = L.map('map').setView([latitude, longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);

                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('Location').openPopup();
                    } else {
                        console.error('Error fetching location data');
                    }
                }
            };
            xhr.send();
        </script>
        <script>
            var locationId = 1; // Replace with the actual location ID you want to fetch
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_location.php?location_id=' + locationId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var locationData = JSON.parse(xhr.responseText);
                        var latitude = locationData.latitude;
                        var longitude = locationData.longitude;

                        var map = L.map('map').setView([latitude, longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                        }).addTo(map);

                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('Location').openPopup();
                    } else {
                        console.error('Error fetching location data');
                    }
                }
            };
            xhr.send();
        </script>

        <script>
            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: 1,
                perMove: 1,
                // height: '10rem',
                type: 'loop',
                arrows: false,
                autoplay: 'true',
            });

            splide.mount();
        </script>
</body>

</html>