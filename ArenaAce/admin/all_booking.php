<?php
include 'config.php';
include './authorization.php';
if (isset($_GET['delete_id'])) {
    $bid = $_GET['delete_id'];
    mysqli_query($con, "delete from arena_booking where id = '$bid'");
    echo "<script>alert('Data Deleted');</script>";
    echo "<script>window.location.href='all_booking.php'</script>";
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
                <div class="col-lg-12">
                    <?php
                    include "config.php";
                    $sql = "SELECT arena_booking.id as bid,arena.name as arena_name,arena_booking.id,arena_booking.user_id,arena_booking.book_number, arena_booking.book_status, arena_booking.remarks, arena_booking.book_at, user.fullname FROM arena_booking INNER JOIN user ON (arena_booking.user_id = user.id) inner join arena on (arena.a_id = arena_booking.arena_id)";
                    $result = mysqli_query($con, $sql) or die("Query failed");
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col" style="width:14%" class="text-center">Book Number</th>
                                        <th scope="col" style="width:14%" class="text-center">Name</th>
                                        <th scope="col" style="width:14%" class="text-center">Arena Name</th>
                                        <th scope="col" style="width:14%" class="text-center">Booking Status</th>
                                        <!-- <th scope="col" style="width:14%" class="text-center">Remarks</th> -->
                                        <th scope="col" style="width:14%" class="text-center">Book Date</th>
                                        <th scope="col" style="width:30%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $row['book_number'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['fullname'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['arena_name'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['book_status'] ?>
                                            </td>
                                            <!-- <td class="text-center">
            <?php //echo $row['remarks'] ?>
        </td> -->
                                            <td class="text-center">
                                                <?php //echo $row['book_at'] ?>
                                                <?php echo date('F j, Y, g:i A', strtotime($row['book_at'])) ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-primary"
                                                    href='view_booking_details.php?id=<?php echo $row["id"]; ?>&&user_id=<?php echo $row['user_id']; ?>&&book_number=<?php echo $row['book_number'] ?>'><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                                <a href="all_booking.php?delete_id=<?php echo $row['bid'] ?>"
                                                    onClick="return confirm('Are you sure you want to delete?')">
                                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>


    </main><!-- End #main -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
            //    "scrollX": true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        });
    </script>

</body>

</html>