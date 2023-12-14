<?php
session_start();
session_regenerate_id(true);
include "config.php";
if (isset($_SESSION['USER'])) {
    //print_r($_SESSION['USER']);
    $user_id = $_SESSION['USER']['id'];
    $user_name = $_SESSION['USER']['fullname'];
    $user_email = $_SESSION['USER']['email'];
    $user_address = $_SESSION['USER']['address'];
    //echo $user_id;
}
?>

<?php
$arena_id = $_GET['arena_id'];
$sport_id = $_GET['sport_id'];
// echo $sport_id;
$sql1 = "SELECT * FROM arena where a_id = '$arena_id'";
$result = mysqli_query($con, $sql1) or die("Query failed");
if (mysqli_num_rows($result) > 0)
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($result); exit;
        $id = $row['a_id'];
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        $image = $row['thumbnail'];
        $description = $row['description'];
        $thumbnail = $row['thumbnail'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    }
    $sliderImage=[];
    $img_query = "SELECT * FROM slider_images where arena_id = $arena_id";
    $imgres =  mysqli_query($con,$img_query);
    while($rows=mysqli_fetch_assoc($imgres)){
        $sliderImage[]=$rows;
    }
    // print_r($sliderImage);exit;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/leaflet.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #1B1B1B;
            color: #ffffff;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 450px;
            object-fit: cover;
        }
    </style>

</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- venue-body section starts -->

    <section id="venue">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="venue-body">
                        <div class="row">
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <div class="venue-top">
                                    <h1 class="venue-name">
                                        <?= $name; ?>
                                    </h1>
                                    <h5 class="venue-address">
                                        <?= $address; ?>
                                    </h5>
                                </div>
                                <div class="venue-slider">
                                    <div class="swiper mySwiper">
                                        
                                        <div class="swiper-wrapper">
                                        <?php
                                        foreach($sliderImage as $sImage){
                                            // print_r($sImage);exit;
                                            ?> <div class="swiper-slide">
                                            <div class="images">
                                                <img src="assets/images/<?= $sImage['image']; ?>" alt="">
                                            </div>
                                        </div> <?php 
                                        }
                                        ?>
                                            
                                            <!-- <div class="swiper-slide">
                                                <div class="images">
                                                    <img src="assets/images/blog2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="swiper-slide">
                                                <div class="images">
                                                    <img src="assets/images/blog3.jpg" alt="">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="swiper-pagination"></div>
                                    </div>
                                </div>
                                <div class="venue-card">
                                    <h2>Sports Available</h2>
                                    <div class="all-sport d-flex align-items-center">
                                        <div class="sports d-flex align-items-center justify-content-center">
                                            <h5>Football</h5>
                                        </div>
                                        <div class="sports d-flex align-items-center justify-content-center">
                                            <h5>Basketball</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="venue-card">
                                    <h2>About Venue</h2>
                                    <p>
                                        <?= $description; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <div class="venue-book">
                                    <a href="checkout.php?arena_id=<?php echo $arena_id; ?>&&sid=<?=$sport_id?>">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-book" type="button">Book Now</button>
                                        </div>
                                    </a>
                                    <div class="row w-full mt-3">
                                        <div class="col-lg-6">
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-share" type="button"><i
                                                        class="fa-solid fa-share"></i><span>Share</span></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="tel:<?= $phone; ?>">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-call" type="button"><i
                                                            class="fa-solid fa-phone"></i><span>Phone</span></button>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="venue-card">
                                    <h2>Offers Available</h2>
                                    <div class="offers">
                                        <span class="badge text-bg-light">No offers available currently</span>
                                    </div>
                                </div>
                                <div class="venue-card">
                                    <h2>Timing</h2>
                                    <div class="times">
                                        <p>5.30 AM - 9:00 PM</p>
                                    </div>
                                </div>
                                <div class="venue-card">
                                    <h2>Location</h2>
                                    <div id="map" style="height:250px;"></div>
                                </div>
                                <div class="venue-book venue-book-below">
                                    <a href="checkout.php?arena_id=<?php echo $arena_id; ?>&&sid=<?=$sport_id?>">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-book" type="button">Book Now</button>
                                        </div>
                                    </a>
                                    <div class="row w-full mt-3">
                                        <div class="col-lg-6">
                                            <div class="d-grid gap-2">
                                                <button class="btn btn-share" type="button"><i
                                                        class="fa-solid fa-share"></i><span>Share</span></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="tel:9762514888">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-call" type="button"><i
                                                            class="fa-solid fa-phone"></i><span>Phone</span></button>
                                                </div>
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
        </div>
    </section>

    <!-- venue-body section ends -->




    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/leaflet.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            mousewheel: true,
            keyboard: true,
            autoplay: true,
            loop: true,
        });
    </script>

    <script>
        // JavaScript code for generating the map using Leaflet.js
        var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map)
            .bindPopup('<?= $name; ?>').openPopup();
    </script>
</body>

</html>