<?php
include './authorization.php';

if (isset($_POST['submit'])) {
    require('config.php');

    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $thumbnail = $_FILES['thumbnail'];
    $sliderImages = $_FILES['slider_images'];

    // Move thumbnail image to destination folder
    $thumbnailFilename = $_FILES['thumbnail']['name'];
    $thumbnailTempname = $_FILES['thumbnail']['tmp_name'];
    move_uploaded_file($thumbnailTempname, 'assets/upload/' . $thumbnailFilename);

    // Insert into arenas table
    if (!empty($sliderImages['name'][0])) {
        $sql = "INSERT INTO arena (name, address, email, phone, description, latitude, longitude, thumbnail, has_slider)
                VALUES ('$name', '$address', '$email', '$phone', '$description', '$latitude', '$longitude', '$thumbnailFilename', 1)";

    } else {
        $sql = "INSERT INTO arena (name, address, email, phone, description, latitude, longitude, thumbnail, has_slider)
                VALUES ('$name', '$address', '$email', '$phone', '$description', '$latitude', '$longitude', '$thumbnailFilename', 0)";

    }
    if (mysqli_query($con, $sql)) {
        // Retrieve the ID of the inserted arena
        $arenaId = mysqli_insert_id($con);

        // Insert slider images into slider_images table
        if (!empty($sliderImages['name'][0])) {
            $totalSliderImages = count($sliderImages['name']);
            for ($i = 0; $i < $totalSliderImages; $i++) {
                $sliderImageFilename = $sliderImages['name'][$i];
                $sliderImageTempname = $sliderImages['tmp_name'][$i];
                move_uploaded_file($sliderImageTempname, 'assets/slider/' . $sliderImageFilename);

                $sliderSql = "INSERT INTO slider_images (arena_id,image)
                              VALUES ('$arenaId','$sliderImageFilename')";
                if (mysqli_query($con, $sliderSql)) {
                    echo "Slider image inserted successfully";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }

        header("Location: arena.php");
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

    <title>Arena Add || Dashboard</title>
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
                        <li class="breadcrumb-item active">Add Arena</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="title-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sportAdd">
                Add New Sport
            </button>
        </div> -->
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
                                        <h6>Add Arena</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="modal-body">
                                                    <div class="row mt-3">
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputName"
                                                                class="form-label text-black fw-bold">Arena Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                                placeholder="Enter Arena Name">
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputAddress"
                                                                class="form-label text-black fw-bold">Address</label>
                                                            <input type="text" class="form-control" name="address"
                                                                placeholder="Enter Arena Address" autocomplete="off">
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputEmail"
                                                                class="form-label text-black fw-bold">Email</label>
                                                            <input type="email" class="form-control" name="email"
                                                                placeholder="Enter Arena Email">
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputPhone"
                                                                class="form-label text-black fw-bold">Phone</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                placeholder="Enter Arena Phone">
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label for="description"
                                                                class="form-label text-black fw-bold">Description</label>
                                                            <textarea class="form-control" name="description"
                                                                id="description" placeholder="Enter Description"
                                                                cols="30" rows="4" maxlength="250"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-dark mt-3">
                                        <div class="card-header bg-dark text-white">
                                            <h6>Image Slider</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mt-3">
                                                        <label class="form-label text-black fw-bold">Slider
                                                            Images</label>
                                                        <div id="imageInputsContainer">
                                                            <div class="image-input-container mb-3">
                                                                <div class="row">
                                                                    <div class="col-lg-5">
                                                                        <input type="file" class="form-control"
                                                                            name="slider_images[]">
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
                                                            Add Image
                                                        </button>
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
                                                <h6>Arena Thumbnail</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div id="imagePreview"></div>
                                                    <label for="inputThumbnail"
                                                        class="form-label text-black fw-bold">Arena Thumbnail</label>
                                                    <input type="file" class="form-control" id="inputThumbnail"
                                                        name="thumbnail" placeholder="Enter Arena thumbnail"
                                                        onchange="previewImage(event)">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card card-dark">
                                            <div class="card-header bg-dark text-white">
                                                Arena Geographic Location
                                            </div>
                                            <div class="card-body">
                                                <div class="row mt-3">
                                                    <div class="col-lg--12 mb-3">
                                                        <div id="map" style="height: 250px; margin-top: 20px;"></div>
                                                    </div>
                                                    <div class="col-lg-12 mb-3">
                                                        <button type="submit" name="point" id="point"
                                                            class="btn btn-primary">Get My Location</button>
                                                    </div>
                                                    <div class="col-lg-12 mb-3">
                                                        <label for="inputPhone"
                                                            class="form-label text-black fw-bold">Latitude</label>
                                                        <input type="text" class="form-control" name="latitude"
                                                            placeholder="Enter Arena Latitiude">
                                                    </div>
                                                    <div class="col-lg-12 mb-3">
                                                        <label for="inputPhone"
                                                            class="form-label text-black fw-bold">Longitude</label>
                                                        <input type="text" class="form-control" name="longitude"
                                                            placeholder="Enter Arena Longitude">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" name="submit" class="btn btn-primary">Add Arena</button>
                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <div class="card card-dark">
                                            <div class="card-header bg-dark text-white">
                                                <h6>sport category</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group mt-3">
                                                            <label class="form-label text-black fw-bold">Sports</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="sport_categ">
                                                                <option selected>select sport category</option>
                                                                <option value="1" name="option1">Football</option>
                                                                <option value="2" name="option2">Volleyball</option>
                                                                <option value="3" name="option3">Baskeball</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit" name="submit"
                                                            class="btn btn-primary mt-4">Add Arena</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-lg-8">

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
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
                imageInput.type = "file";
                imageInput.classList.add("form-control");
                imageInput.name = "slider_images[]";

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

        var map = L.map('map').setView([51.505, -0.09], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
            maxZoom: 18
        }).addTo(map);

        // Display the marker on the map based on the latitude and longitude input values
        function displayMarker() {
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude').value;

            if (latitude && longitude) {
                var marker = L.marker([latitude, longitude]).addTo(map);
                map.setView([latitude, longitude], 13);
                marker.bindPopup("Arena Location").openPopup();
            }
        }

        // Call the displayMarker function when the page loads
        window.addEventListener('load', displayMarker);

    </script>

    <script>
        // Function to get the user's current location
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            }
        }

        // Function to handle successful retrieval of geolocation coordinates
        function showPosition(position) {
            document.querySelector('.myForm input[name="latitude"]').value = position.coords.latitude;
            document.querySelector('.myForm input[name="longitude"]').value = position.coords.longitude;
        }

        // Function to handle errors in geolocation retrieval
        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("You must allow the request for geolocation to fill out the form.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred while retrieving the location.");
                    break;
            }
        }

        // Attach an event listener to the "Get My Location" button
        document.getElementById('point').addEventListener('click', function (e) {
            e.preventDefault();
            getLocation();
        });
    </script>
    <!-- <script>
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
</script> -->

    <!--  Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>