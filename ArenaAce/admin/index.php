<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['AdminLoginId'])) {
  header("location: login.php");
}
?>

<?php
require('config.php');
$sql = "SELECT COUNT(*) as arenaCount FROM arena";
$res = mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
$arenaCount = $row['arenaCount'];


$sql = "SELECT COUNT(*) as sportCount FROM sport";
$res = mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
$sportCount = $row['sportCount'];

$sql = "SELECT COUNT(*) as bookCount FROM arena_booking";
$res = mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);
$bookCount = $row['bookCount'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Arena Add || Dashboard</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link href="assets/css/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/boxicons.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <?php
  require("header.php");
  ?>

  <?php
  require("sidebar.php");
  ?>




  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              All Arena
            </div>
            <div class="card-body">
              <h5 class="card-title"><?= $arenaCount?></h5>
              <a href="#" class="btn btn-primary">Go to arena</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              All Sport
            </div>
            <div class="card-body">
              <h5 class="card-title"><?= $sportCount?></h5>
              <a href="#" class="btn btn-primary">Go to sport</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              Total Booking
            </div>
            <div class="card-body">
              <h5 class="card-title"><?= $bookCount?></h5>
              <a href="#" class="btn btn-primary">Go to Booking</a>
            </div>
          </div>
        </div>


      </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <!-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>ArenaAce</span></strong>. All Rights Reserved
    </div>
    <div class="credits"> -->


    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/simple-datatables.js"></script>


  <!--  Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>