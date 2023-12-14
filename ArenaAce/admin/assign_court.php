<?php
include './authorization.php';
require('config.php');
if (isset($_POST['submit'])) {
    $arena_id = $_POST['arena_id'];
    $sport_id = $_POST['sport_id'];
    $court_id = $_POST['court_id'];
    // file upload code start

    $sql = "INSERT INTO `assign_court`(`arena_id`, `sport_id`,court_id) VALUES ('$arena_id','$sport_id','$court_id')";

    // echo $sql; exit;

    if (mysqli_query($con, $sql) or die("query failed")) {
        header("Location: assign_court.php");
    }
}
if(isset($_GET['delete_id'])){
    $sid = $_GET['delete_id'];
    mysqli_query($con, "delete from assign_court where id = '$sid'");
    echo "<script>alert('Data Deleted');</script>";
    echo "<script>window.location.href='assign_court.php'</script>";
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
                <h1>Sports</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Arena</a></li>
                        <li class="breadcrumb-item active">Assign Sports</li>
                    </ol>
                </nav>
            </div>
        </div>

        <section class="section dashboard" onload="getLocation();">
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"
                        enctype="multipart/form-data" class="myForm">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card card-dark">
                                    <div class="card-header bg-dark text-white">
                                        <h6>Assign Courts to Arena</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="modal-body">
                                                    <div class="row mt-3">
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Arena</label>
                                                            <select id="inputState" name="arena_id"
                                                                class="form-control">
                                                                <option selected>Select Arena</option>
                                                                <?php
                                                                include "config.php";
                                                                $sql = "SELECT a_id,name FROM arena";
                                                                $result = mysqli_query($con, $sql) or die("Query failed");
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $id = $row['a_id'];
                                                                        $name = $row['name'];

                                                                        ?>
                                                                        <option value="<?= $id; ?>">
                                                                            <?php echo $name; ?>
                                                                        </option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Sports</label>
                                                            <select id="inputState" name="sport_id"
                                                                class="form-control">
                                                                <option selected>Select Sports</option>
                                                                <?php
                                                                include "config.php";
                                                                $sql = "SELECT s_id,name FROM sport";
                                                                $result = mysqli_query($con, $sql) or die("Query failed");
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $id = $row['s_id'];
                                                                        $name = $row['name'];

                                                                        ?>
                                                                        <option value="<?= $id; ?>">
                                                                            <?php echo $name; ?>
                                                                        </option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState">Courts</label>
                                                            <select id="inputState" name="court_id"
                                                                class="form-control">
                                                                <option selected>Select Courts</option>
                                                                <?php
                                                                include "config.php";
                                                                $sql = "SELECT court_id,name FROM courts";
                                                                $result = mysqli_query($con, $sql) or die("Query failed");
                                                                if (mysqli_num_rows($result) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $id = $row['court_id'];
                                                                        $name = $row['name'];

                                                                        ?>
                                                                        <option value="<?= $id; ?>">
                                                                            <?php echo $name; ?>
                                                                        </option>
                                                                    <?php }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 mt-4">
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary">Assign Court</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mt-3">
                                <div class="col">
                                    <?php
                                    include "config.php";
                                    $sql = "select assign_court.id as aid,arena.name as arena,sport.name as sport,courts.name as court_name from arena inner join assign_court on (arena.a_id = assign_court.arena_id) inner join  sport on (sport.s_id = assign_court.sport_id ) inner join courts on (courts.court_id = assign_court.court_id)";
                                    $result = mysqli_query($con, $sql) or die("Query failed");
                                    if (mysqli_num_rows($result) > 0) {
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <!-- <th scope="col">S.N.</th> -->
                                                        <th scope="col" style="width:14%" class="">SN</th>
                                                        <th scope="col" style="width:14%" class="">Arena</th>
                                                        <th scope="col" style="width:14%" class="">Sport</th>
                                                        <th scope="col" style="width:14%" class="">Court</th>
                                                        <th scope="col" style="width:14%" class="">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 0;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $i++
                                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?= $i ?>
                                                            </td>
                                                            <td class="">
                                                                <?php echo $row['arena'] ?>
                                                            </td>
                                                            <td class="">
                                                                <?php echo $row['sport'] ?>
                                                            </td>
                                                            <td class="">
                                                                <?php echo $row['court_name'] ?>
                                                            </td>
                                                            <td>
                                                                <a href="assign_court.php?delete_id=<?php echo $row['aid'] ?>"
                                                                    onClick="return confirm('Are you sure you want to delete?')">
                                                                    <button class="btn btn-danger"><i
                                                                            class="fa-solid fa-trash"></i></button>
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
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById("imagePreview");

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview Image" style="max-width: 100%; height: auto;">';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        function showPosition(position) {
            document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You must allow the request for geolocation to fill out the form.");
                    location.reload();
                    break;
            }
        }
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>