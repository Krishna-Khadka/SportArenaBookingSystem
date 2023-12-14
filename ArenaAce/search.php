<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- search section starts -->
    <section id="search" style="background: linear-gradient(#000A,#000A),url(assets/images/searchbg.jpg);">
            <!-- <div class="search-wrapper">
                <form action="#" method="POST">
                    <h1>Ready to find sport complexes around you</h1>
                    <input type="search" name="search" id="search" placeholder="search for cities, places....">
                </form>
            </div> -->
            <div class="search-box">
                <h2>Ready to Find Sports Complexes Around You</h2>
                <form action="#" class="d-flex align-items-center justify-content-center">
                    <input type="search" name="search_sport" id="search_sport" class="form-control" placeholder="search for cities, places....">
                    <button type="submit" name="search"><i class="fa-solid fa-magnifying-glass-location"></i></button>
                </form>
                <p>popular cities</p>
                <div class="row">
                    <div class="col-lg-4 mt-3">
                        <a href="#">Itahari</a>    
                    </div>
                    <div class="col-lg-4 mt-3">
                        <a href="#">Belbari</a>    
                    </div>
                    <div class="col-lg-4 mt-3">
                        <a href="#">Khorsane</a>    
                    </div>      
                    <div class="col-lg-4 mt-3">
                        <a href="#">Biratnagar</a>    
                    </div>      
                    <div class="col-lg-4 mt-3">
                        <a href="#">Dharan</a>    
                    </div>      
                    <div class="col-lg-4 mt-3">
                        <a href="#">Kathmandu</a>    
                    </div>      
                </div>
            </div>
    </section>
    <!-- search section ends -->


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