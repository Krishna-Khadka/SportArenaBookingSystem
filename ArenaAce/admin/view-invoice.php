<?php 
include './authorization.php';
include "config.php";


if(isset($_GET['invoiceid'])){
    $bill_no = $_GET['invoiceid'];
}
    

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
    <link href="assets/css/all.css" rel="stylesheet">

</head>

<body>

    <?php
    require("header.php");
    ?>

    <?php
    require("sidebar.php");
    ?>

    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between">
            <div class="title-left">
                <h1>Users</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="section dashboard">
            <div class="row">
                <?php
                include "config.php";
                $sql = "select user.fullname, arena.name,arena_booking.*,invoice.billing_number,invoice.billing_date,payment.* from arena_booking inner join payment on (arena_booking.book_number = payment.book_number) inner join invoice on (invoice.billing_number = payment.invoice_id)inner join arena on (arena_booking.arena_id = arena.a_id) inner join user on (user.id = arena_booking.user_id) where invoice.billing_number = $bill_no";
                $result = mysqli_query($con, $sql) or die("Query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Arena Name: <?php echo $row['name']; ?></h5>
                                    <p class="card-text">Book Number: <?php echo $row['book_number']; ?></p>
                                    <p class="card-text">Name: <?php echo $row['fullname']; ?></p>
                                    <p class="card-text">Booking Status: <?php echo $row['book_status']; ?></p>
                                    <p class="card-text">Amount: <?php echo $row['payable_amount']; ?></p>
                                    <p class="card-text">Payment Status: <?php echo $row['payment_status']; ?></p>
                                    <p class="card-text">Book Date: <?php echo date('F j, Y, g:i A', strtotime($row['book_at'])); ?></p>
                                    <!-- <div class="text-center">
                                        <a class="btn btn-primary" href='view_booking_details.php?id=<?php echo $row["id"]; ?>&user_id=<?php echo $row['user_id']; ?>&book_number=<?php echo $row['book_number'] ?>'><i class="fa-solid fa-circle-info"></i></a>
                                        <a href="all_booking.php?delete_id=<?php echo $row['bid'] ?>" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script>
        $('#myTable').DataTable({
            "ordering": false,
            "lengthMenu": [
                [3, 10, 25, 50, 100, -1],
                [3, 10, 25, 50, 100, 'All']
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    </script>

</body>

</html>

