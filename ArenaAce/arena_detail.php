<?php 
    session_start();
    session_regenerate_id(true); 
    // if(!isset($_SESSION['LoginId'])){
    //     header("location: login.php");
    // }
?>

<?php 
  $arena_id = $_GET['arena_id'];
  //echo $id;
  include "config.php";
  $sql = "SELECT * FROM arena where a_id = '$arena_id'";
  $result = mysqli_query($con,$sql) or die("Query failed");
  
  if(mysqli_num_rows($result) > 0)
      while($row = mysqli_fetch_assoc($result)){
     // print_r($result); exit;
      $id = $row['a_id'];
      $name = $row['name']; 
      $image = $row['thumbnail'];   
      $description = $row['description'];
      $latitude = $row['latitude'];
      $longitude = $row['longitude'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arenas | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="assets/css/splide.min.css">
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
                <h1> Arena Detail</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="arena.php">Arena Detail</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- arena-info section starts -->

    <section id="arena-info">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="arena-desc">
                        <h2><?=$name;?></h2>
                        <div class="banner">
                            <img src="admin/assets/upload/<?=$image?>" alt="" class="img-fluid">
                        </div>
                        <?=$description?>
                </div>
                <div class="col-md-6">
                    <div class="arena-info-list">
                        <h3>Our Marks Park Arena Offers:</h3>
                        <ul>
                            <li><i class="fa-solid fa-circle"></i>5-a-side soccer, leagues and friendlies.</li>
                            <li><i class="fa-solid fa-circle"></i>Social and competitive leagues, join your team today!
                            </li>
                            <li><i class="fa-solid fa-circle"></i>Host your own function or event, or let us assist you.
                            </li>
                            <li><i class="fa-solid fa-circle"></i>Birthday parties for all ages</li>
                            <li><i class="fa-solid fa-circle"></i>Tournaments</li>
                            <li><i class="fa-solid fa-circle"></i>Ad-hoc bookings / Corporate days / friendlies</li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!-- arena-info section ends -->

    <!-- arena-review section starts -->

    <section id="arena-review">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h6 class="sub-heading">testimonials</h6>
                    <h2 class="heading">our customer say</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="splide pt-4" aria-label="Splide Basic HTML Example">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide text-center">
                                    <div class="review-image">
                                        <img src="assets/images/team1.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p class="pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex justify-content-center p">
                                            <p class="author">Krishna Khadka</p>
                                            <p class="location">Khorsane</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide text-center">
                                    <div class="review-image">
                                        <img src="assets/images/team1.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p class="pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex justify-content-center p">
                                            <p class="author">Krishna Khadka</p>
                                            <p class="location">Khorsane</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="splide__slide text-center">
                                    <div class="review-image">
                                        <img src="assets/images/team1.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-text">
                                            <p class="pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                                Odit, nulla
                                                error doloremque ipsam
                                                officia eveniet? Dolorem, magnam tempora minus nihil porro facilis
                                                voluptatum delectus voluptate
                                                quas illum provident fugit cupiditate.</p>
                                        </div>
                                        <div class="review-author d-flex justify-content-center p">
                                            <p class="author">Krishna Khadka</p>
                                            <p class="location">Khorsane</p>
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

    <!-- arena-review section ends -->

    <!-- contact-form section start -->

    <section id="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div id="map" style="height: 400px;">
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
    </section>

    <!-- contact-form section end -->





    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/js/splide.min.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script>
        var latitude = <?php echo $latitude; ?>;
        var longitude = <?php echo $longitude; ?>;

        var map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map);

        // Optionally, you can customize the marker icon
        var icon = L.icon({
            iconUrl: 'path/to/your/icon.png',
            iconSize: [width, height],
            iconAnchor: [anchorX, anchorY]
        });
        L.marker([latitude, longitude], { icon: icon }).addTo(map);
    </script>
    <script>
        var splide = new Splide('.splide', {
            type   : 'loop',
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