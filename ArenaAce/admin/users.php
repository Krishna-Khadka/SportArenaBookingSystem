<?php
require('config.php');
include './authorization.php';
if (isset($_GET['delete_id'])) {
    $cid = $_GET['delete_id'];
    mysqli_query($con, "delete from user where id = '$cid'");
    echo "<script>alert('Data Deleted');</script>";
    echo "<script>window.location.href='users.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Users || Dashboard</title>

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
                    $sql = "SELECT * FROM user";
                    $result = mysqli_query($con, $sql) or die("Query failed");
                    if (mysqli_num_rows($result) > 0) {
                        ?>
                        <div class="table-responsive">
                            <table class="table" id="myTable">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <!-- <th scope="col">S.N.</th> -->
                                        <th scope="col" style="width:14%" class="text-center">Full Name</th>
                                        <th scope="col" style="width:14%" class="text-center">Image</th>
                                        <th scope="col" style="width:14%" class="text-center">Email</th>
                                        <th scope="col" style="width:14%" class="text-center">Address</th>
                                        <th scope="col" style="width:14%" class="text-center">Phone</th>
                                        <th scope="col" style="width:30%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $row['fullname'] ?>
                                            </td>
                                            <td class="text-center"> <img
                                                    src="<?php echo '../assets/upload/' . $row['u_image']; ?>"
                                                    class="img-fluid rounded-start" height="100px" width="100px" alt="">
                                            </td>
                                            <!-- <img src="./assets/upload/about1" alt=""> -->
                                            <td class="text-center">
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['address'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['phone'] ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-primary"
                                                    href='users_profile.php?id=<?php echo $row["id"]; ?>'><i
                                                        class="fa-solid fa-eye"></i></a>
                                                <a href="users.php?delete_id=<?php echo $row['id'] ?>"
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