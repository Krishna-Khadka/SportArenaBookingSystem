<?php
include './authorization.php';

if (isset($_POST['submit'])) {
    require('config.php');
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sql = "INSERT INTO courts (name, price)
            VALUES ('$name','$price')";
    if (mysqli_query($con, $sql)) {
        header("Location: courts.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Add Court || Dashboard</title>
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

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"
                        enctype="multipart/form-data" class="myForm">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card card-dark">
                                    <div class="card-header bg-dark text-white">
                                        <h6>Add Court</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="modal-body">
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputName"
                                                                class="form-label text-black fw-bold">Court Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Enter Court Name">
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputPrice"
                                                                class="form-label text-black fw-bold">Price</label>
                                                            <input type="text" class="form-control" name="price"
                                                                placeholder="Enter Court Price">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-dark">
                                            <div class="card-header bg-dark text-white">
                                                <h6>Add Court</h6>
                                            </div>
                                            <div class="card-body">
                                                <button type="submit" name="submit" class="btn btn-primary mt-3">Add
                                                    Court</button>
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

    </main>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>


</body>

</html>