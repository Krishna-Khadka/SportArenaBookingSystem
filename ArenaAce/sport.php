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
    <title>Sports | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <?php include "bot.php"; ?>

    <!-- banner section starts -->

    <section id="banner" style="background: linear-gradient(#000C,#000C),url(assets/images/contactbg.jpg);">
        <div class="container">
            <div class="banner-field text-center">
                <h1>Our Sports</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="sport.php">Sports</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

        <!-- sport section starts -->

        <section id="sports">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title text-center">
                        <h6 class="sub-heading">our sports</h6>
                        <h2 class="heading">latest Sports</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                    include "config.php";
                    $sql = "SELECT * FROM sport";
                    $result = mysqli_query($con,$sql) or die("Query failed");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                        $id = $row['s_id'];
                        $name = $row['name']; 
                        $image = $row['image'];   
                        // $description = $row['description'];
                        // $truncated_description = strlen($description) > 50 ? substr($description, 0, 50) . '...' : $description;
                    
                ?>
                <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/<?=$image;?>" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3><?=$name?></h3>
                            <a href="arena.php?id=<?=$id?>&&sport=<?=$name?>">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                            <!-- <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a> -->
                        </div>
                    </div>
                </div>
                <?php 
                      }
                    }  
                ?>
                <!-- <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/cricket.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3>cricket</h3>
                            <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/basketball.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3>basketball</h3>
                            <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/volleyball.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3>volleyball</h3>
                            <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/badminton.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3>badminton</h3>
                            <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sport-card">
                        <div class="images">
                            <img src="assets/images/futsal.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sport-content">
                            <h3>futsal</h3>
                            <a href="arena.php">view arena <i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!-- sport section starts -->


    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>