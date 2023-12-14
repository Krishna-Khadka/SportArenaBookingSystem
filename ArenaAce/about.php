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
    <title>About Us | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>
    <div id="searchResult"></div>

    <!-- Navbar section ends -->

    <!-- banner section starts -->

    <section id="banner" style="background: linear-gradient(#000C,#000C),url(assets/images/contactbg.jpg);">
        <div class="container">
            <div class="banner-field text-center">
                <h1>About Us</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="about.php">About Us</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- about-content section starts -->

    <section id="about-content">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="title">
                        <h2 class="heading">more than just a sport booking website!</h2>
                    </div>
                    <div class="about-text">
                        <p>Eleifend est vitae, tincidunt ligula. Morbi pharetra sem id lectus iaculis, nec commodo
                            mauris interdum. Quisque ipsum neque, ullamcorper in diam nec, mollis rutrum nulla.
                            Curabitur porta quis ante laoreet lobortis. Etiam non sagittis sapien, et porttitor diam
                            leo.</p>
                        <p>Etiam ornare, mauris vitae aliquam feugiat, velit velit blandit turpis, eu ultricies quam
                            magna non urna. Nulla odio justo, hendrerit quam eget, pharetra lacinia tellus. Suspendisse
                            ac lorem congue, cursus sem sit amet, tincidunt erat. Sed in malesuada urna. </p>
                        <a href="sport.php"> <span></span>view sports</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="images">
                        <img src="assets/images/about1.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- about-content section ends -->

    <!-- games section starts -->

    <section id="games">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="game-name">
                        <img src="assets/images/football.png" class="img-fluid" alt="">
                        <h3>Football</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error veritatis neque tenetur, eius
                            nam quas.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="game-name">
                        <img src="assets/images/basketball.png" class="img-fluid" alt="">
                        <h3>Basketball</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error veritatis neque tenetur, eius
                            nam quas.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="game-name">
                        <img src="assets/images/volleyball.png" class="img-fluid" alt="">
                        <h3>Volleyball</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error veritatis neque tenetur, eius
                            nam quas.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="game-name">
                        <img src="assets/images/badminton.png" class="img-fluid" alt="">
                        <h3>Badminton</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error veritatis neque tenetur, eius
                            nam quas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- games section ends -->

    <!-- estb section starts -->

    <section id="estb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="title">
                        <h6 class="sub-heading">best services</h6>
                        <h2 class="heading">astounding services since 2020</h2>
                    </div>
                    <div class="estb-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus vel sit cum sunt omnis eius
                            sapiente nobis et optio obcaecati quibusdam minima numquam commodi quasi, perferendis
                            explicabo
                            consequatur quis maiores eaque, fugit pariatur dolorum ea!</p>
                        <a href="#"> <span></span>view services</a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="estb-images">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="images-left">
                                    <img src="assets/images/about1.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="images-right">
                                    <img src="assets/images/home2.jpg" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- estb section ends -->

    <!-- features section starts -->

    <section id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-box d-flex align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-file-pen"></i>
                        </div>
                        <div class="feature-content">
                            <h5>fast booking</h5>
                            <p>make covenient arena booking</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-box d-flex align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-volleyball"></i>
                        </div>
                        <div class="feature-content">
                            <h5>multiple games</h5>
                            <p>choose wide range of games</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-box d-flex align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                        <div class="feature-content">
                            <h5>money returns</h5>
                            <p>guarenteed 100% refund</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="feature-box d-flex align-items-center">
                        <div class="icon">
                            <i class="fa-solid fa-gem"></i>
                        </div>
                        <div class="feature-content">
                            <h5>special discount</h5>
                            <p>best offer will bring you joy</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- features section ends -->

    <!-- team section starts -->

    <section id="team" style="background: url(assets/images/bgDark.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="title">
                        <h2 class="heading">our team</h2>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-wrapper">
                        <div class="images">
                            <img src="assets/images/team1.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-detail">
                            <h2>Krishna Khadka</h2>
                            <p>Website Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-wrapper">
                        <div class="images">
                            <img src="assets/images/team2.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-detail">
                            <h2>Suman Parajuli</h2>
                            <p>Website Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-wrapper">
                        <div class="images">
                            <img src="assets/images/team3.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-detail">
                            <h2>Rahul Shah</h2>
                            <p>UI/UX Designerr</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="team-wrapper">
                        <div class="images">
                            <img src="assets/images/team4.jpg" class="img-fluid" alt="">
                            <div class="social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-github"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-detail">
                            <h2>Love Kumar Rajbanshi</h2>
                            <p>Website Manager</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- team section ends -->



    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

<!-- <script>
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
            });
            }
        });
        });
    });
</script> -->
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
            $('#searchResult').html(data);
            },
            error: function(xhr, status, error) {
          // Handle error if the Ajax request fails
          console.error(error);
        }
        });
    });
});
    </script>
</body>

</html>