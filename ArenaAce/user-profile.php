<?php
include 'config.php';
session_start();
session_regenerate_id(true);


if (!isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'client') {
    header('location:userLogin.php');
    die();
}

if (isset($_SESSION['USER'])) {
    $info = $_SESSION['USER'];
    $user_id = $info['id'];
}
include "config.php";
$sql = "select * from user where id = $user_id";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #1B1B1B;
            color: #ffffff;
        }
    </style>

</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- profile section starts -->

    <section id="profile">
        <div class="container">
            <div class="row" style="width:80%;margin:0 auto;">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="assets/images/<?= $row['u_image'] ?>" alt="Profile">
                            <h2>
                                <?= $row['fullname'] ?>
                            </h2>
                            <h3>
                                <?= $row['email'] ?>
                            </h3>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#" class="facebook"><i class="fa-brands fa-facebook"></i></a>
                                <a href="#" class="instagram"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="fa-brands fa-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <!-- <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li> -->

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#my_booking">My
                                        Booking</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?= $row['fullname'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?= $row['address'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?= $row['phone'] ?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            <?= $row['email'] ?>
                                        </div>
                                    </div>

                                    <hr>
                                    <?php
                                    $sql = "SELECT arena_booking.id as bid,arena.name as arena_name,arena_booking.id,arena_booking.user_id,arena_booking.book_number, arena_booking.book_status, arena_booking.remarks, arena_booking.book_at, user.fullname FROM arena_booking INNER JOIN user ON (arena_booking.user_id = user.id) inner join arena on (arena.a_id = arena_booking.arena_id) where user.id = $user_id";
                                    $result = mysqli_query($con, $sql) or die("Query failed");

                                    if (mysqli_num_rows($result) > 0) {


                                        ?>
                                        Booking Details
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Booking Status</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <?php
                                                    if ($row['book_status'] == 'pending') {
                                                        echo "Pending";
                                                    } elseif ($row['book_status'] == 'canceled') {
                                                        echo "Canceled";

                                                    } elseif ($row['book_status'] == 'rejected') {
                                                        echo "Rejected";

                                                    } elseif ($row['book_status'] == 'select') {
                                                        echo "Selected";
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Arena Name</div>
                                                <div class="col-lg-9 col-md-8">
                                                    <?= $row['arena_name'] ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                <?php } ?>

                                <!-- <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    
                                    <form>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                <img src="assets/images/team1.jpg" alt="Profile">
                                                <div class="pt-2">
                                                    <a href="#" class="btn btn-primary btn-sm"
                                                        title="Upload new profile image"><i
                                                            class="fa-solid fa-upload"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        title="Remove my profile image"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fullName" type="text" class="form-control" id="fullName"
                                                    value="Krishna Khadka">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address"
                                                class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="address" type="text" class="form-control" id="Address"
                                                    value="Sundarharaincha-12, Khorsane Morang">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone"
                                                    value="+977 9762514888">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="krishkhadka2059@example.com">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>

                                </div> -->

                                <!-- <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>

                                </div> -->

                                <div class="tab-pane fade show" id="my_booking">

                                    <h5 class="card-title">My Booking Details</h5>

                                    <div class="row">
                                        <?php
                                        include "config.php";
                                        $sqlQuery = "SELECT arena_booking.id as bid,arena.name as arena_name,arena_booking.id,arena_booking.user_id,arena_booking.book_number, arena_booking.book_status, arena_booking.remarks, arena_booking.book_at, user.fullname FROM arena_booking INNER JOIN user ON (arena_booking.user_id = user.id) inner join arena on (arena.a_id = arena_booking.arena_id) where arena_booking.user_id = $user_id ";
                                        $results = mysqli_query($con, $sqlQuery) or die("Query failed");
                                        if (mysqli_num_rows($results) > 0) {
                                            ?>
                                            <div class="col-lg-12">
                                                <table class="table text-white">
                                                    <thead>
                                                        <tr>
                                                            <th> Book Number</th>
                                                            <th>Arena Name</th>
                                                            <th>Book Status</th>
                                                            <th> Book Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($results)) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $row['book_number'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['arena_name'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['book_status'] ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('F j, Y, g:i A', strtotime($row['book_at'])) ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <br><br>
                                    <!-- <h5 class="card-title">Invoice Details</h5> -->
                                    <hr>
                                    <!-- <div class="row">
                                        <?php
                                        include "config.php";
                                        $QueryInvoice = "select DISTINCT user.fullname,invoice.billing_number,invoice.billing_date,payment.payable_amount from user inner join invoice on (user.id = invoice.user_id) inner join payment on invoice.billing_number = payment.invoice_id where invoice.user_id = $user_id ";
                                        $resultInvoice = mysqli_query($con, $QueryInvoice) or die("Query failed");
                                        if (mysqli_num_rows($resultInvoice) > 0) {
                                            ?>
                                            <div class="col-lg-12">
                                                <table class="table text-white">
                                                    <thead>
                                                        <tr>
                                                            <th>Invoice Number</th>
                                                            <th>Name</th>
                                                            <th>Billing Date</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($resultInvoice)) {
                                                            ?>
                                                            <tr>
                                                                <td>#
                                                                    <?php echo $row['billing_number']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['fullname']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('F j, Y, g:i A', strtotime($row['billing_date'])) ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row['payable_amount']; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                    </div> -->
                                </div>


                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- profile section ends -->




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