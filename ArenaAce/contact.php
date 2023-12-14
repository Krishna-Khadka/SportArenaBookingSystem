<?php 
    session_start();
    session_regenerate_id(true); 
    // if(!isset($_SESSION['LoginId'])){
    //     header("location: login.php");
    // }
?>

<?php
  require('config.php'); 
  
  if(isset($_POST['submit'])){
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $message = $_POST['message'];

    $sql = "INSERT INTO `contact`(`fullName`,`email`,`address`,`message`) VALUES('{$fullName}','{$email}','{$address}','{$message}')";

    if(mysqli_query($con,$sql) or die("query failed")){
        header("location: contact.php");
    }
  }
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
                <h1>Contact Us</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- banner section ends -->

    <!-- contact-info section starts -->

    <section id="contact-info">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4 wrapper">
                    <div class="box">
                        <i class="fa-solid fa-phone"></i>
                        <h3>phone</h3>
                        <p class="phone-info">Toll-Free: <span>+977 9804083083</span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fa-solid fa-envelope"></i>
                        <h3>Email</h3>
                        <p>krishparajuli57@gmail.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <i class="fa-solid fa-location-arrow"></i>
                        <h3>Address</h3>
                        <p>Itahari, Sunsari</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact-info section ends -->

    <!-- contact-form section start -->

    <section id="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3565.9180316792504!2d87.27267597498972!3d26.65110677128492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ef6dd263d32fa7%3A0x60a68c89ed3190b4!2sItahari%20Namuna%20College!5e0!3m2!1sen!2snp!4v1683597835194!5m2!1sen!2snp"
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
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-3">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fullName" placeholder="Your FullName">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" placeholder="Your Address">
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control" name="message" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <input type="submit" value="SUBMIT" name="submit" class="btn px-5">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- contact-form section end -->




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