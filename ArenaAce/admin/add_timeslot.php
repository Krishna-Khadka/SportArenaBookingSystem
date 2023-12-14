<?php
include './authorization.php';
require('config.php');
if (isset($_POST['submit'])) {
    // $arena_id = $_POST['arena_id'];
    // $sport_id = $_POST['sport_id'];
    $court_id = $_POST['court_id'];
    $time_slots = $_POST['time_slots'];
    $date = $_POST['date'];
    // print_r($time_slots);
    // echo $time_slots[0]; exit;
    // file upload code start

    foreach ($time_slots as $time_slots) {

        $sql = "INSERT INTO `time_slots`(`court_id`, `date`,time) VALUES ('$court_id','$date','$time_slots')";
        $result = mysqli_query($con, $sql);
    }


    // echo $sql; exit;
    if ($result or die("query failed")) {
        header("Location: add_timeslot.php");
    }
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
                                        <h6>Add Time Slot in Court</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="modal-body">
                                                    <div class="row mt-3">
                                                        <!-- <div class="form-group col-md-4">
                                <label for="inputState">Arena</label>
                                <select id="inputState" name="arena_id" class="form-control">
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
                                    <option value="<?= $id; ?>"><?php echo $name; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                </div> -->
                                                        <!-- <div class="form-group col-md-4">
                                <label for="inputState">Sports</label>
                                <select id="inputState" name="sport_id" class="form-control">
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
                                     <option value="<?= $id; ?>"><?php echo $name; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                                </div>   -->
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
                                                        <div class="form-group mt-3">
                                                            <label class="form-label text-black fw-bold">Date & Time</label>
                                                            <div id="imageInputsContainer">
                                                                <div class="image-input-container mb-3">
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <input type="date" class="form-control"
                                                                                name="date">
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <input type="time" class="form-control"
                                                                                name="time_slots[]">
                                                                        </div>
                                                                        <div class="col-lg-2">
                                                                            <button type="button"
                                                                                class="btn btn-danger remove-image-input">
                                                                                Remove
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-primary mt-3"
                                                                id="addImageInput">
                                                                Add Time
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-4 mt-4">
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary">Add TimeSlots</button>
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
                                    $sql = "select arena.name as arena,sport.name as sport,courts.name as court_name from arena inner join assign_court on (arena.a_id = assign_court.arena_id) inner join  sport on (sport.s_id = assign_court.sport_id ) inner join courts on (courts.court_id = assign_court.court_id)";
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addImageInputButton = document.getElementById("addImageInput");
            const imageInputsContainer = document.getElementById("imageInputsContainer");

            addImageInputButton.addEventListener("click", function () {
                const imageInputContainer = document.createElement("div");
                imageInputContainer.classList.add("image-input-container", "mb-3");

                const row = document.createElement("div");
                row.classList.add("row");

                const imageInputCol = document.createElement("div");
                imageInputCol.classList.add("col-lg-5");

                const imageInput = document.createElement("input");
                imageInput.type = "time";
                imageInput.classList.add("form-control");
                imageInput.name = "time_slots[]";

                imageInputCol.appendChild(imageInput);
                row.appendChild(imageInputCol);

                const removeButtonCol = document.createElement("div");
                removeButtonCol.classList.add("col-lg-2");

                const removeButton = document.createElement("button");
                removeButton.type = "button";
                removeButton.classList.add("btn", "btn-danger", "remove-image-input");
                removeButton.textContent = "Remove";

                removeButton.addEventListener("click", function () {
                    imageInputContainer.remove();
                });

                removeButtonCol.appendChild(removeButton);
                row.appendChild(removeButtonCol);

                imageInputContainer.appendChild(row);
                imageInputsContainer.appendChild(imageInputContainer);
            });

            const removeImageInputButtons = document.querySelectorAll(".remove-image-input");
            removeImageInputButtons.forEach(function (button) {
                button.addEventListener("click", function () {
                    const imageInputContainer = button.closest(".image-input-container");
                    imageInputContainer.remove();
                });
            });
        });

    </script>

    <script src="assets/js/main.js"></script>

</body>

</html>