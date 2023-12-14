<?php
include './authorization.php';
require('config.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $description = $_POST['description'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // File upload code start
    $filenames = array();
    if (!empty($_FILES['thumbnails']['name'][0])) {
        $totalFiles = count($_FILES['thumbnails']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            $tempname = $_FILES['thumbnails']['tmp_name'][$i];
            $filename = $_FILES['thumbnails']['name'][$i];
            move_uploaded_file($tempname, 'assets/upload/' . $filename);
            $filenames[] = $filename;
        }
    }
    // File upload code end

    $sql = "INSERT INTO `arena`(`name`, `address`, `email`, `phone`, `description`, `latitude`, `longitude`) VALUES ('$name','$address','$email','$phone','$description','$latitude','$longitude')";

    if (mysqli_query($con, $sql) or die("query failed")) {
        $arena_id = mysqli_insert_id($con);
        if (!empty($filenames)) {
            $values = array();
            foreach ($filenames as $filename) {
                $values[] = "($arena_id, '$filename')";
            }
            $valuesString = implode(',', $values);
            $sql = "INSERT INTO `arena_images`(`arena_id`, `image`) VALUES $valuesString";
            mysqli_query($con, $sql);
        }
        header("Location: arena.php");
    }
}
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
                                                        <label for="inputEmail"
                                                            class="form-label text-black fw-bold">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            placeholder="Enter Email">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputAddress"
                                                            class="form-label text-black fw-bold">Address</label>
                                                        <input type="text" class="form-control" name="address"
                                                            placeholder="Enter Address">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputPhone"
                                                            class="form-label text-black fw-bold">Phone</label>
                                                        <input type="tel" class="form-control" name="phone"
                                                            placeholder="Enter Phone Number">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-12 mb-3">
                                                        <label for="inputDescription"
                                                            class="form-label text-black fw-bold">Description</label>
                                                        <textarea class="form-control" name="description"
                                                            placeholder="Enter Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputThumbnail"
                                                            class="form-label text-black fw-bold">Thumbnail
                                                            Images</label>
                                                        <input type="file" class="form-control" name="thumbnails[]"
                                                            multiple accept="image/*">
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputLatitude"
                                                            class="form-label text-black fw-bold">Latitude</label>
                                                        <input type="text" class="form-control" name="latitude"
                                                            id="latitude" placeholder="Latitude" readonly>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputLongitude"
                                                            class="form-label text-black fw-bold">Longitude</label>
                                                        <input type="text" class="form-control" name="longitude"
                                                            id="longitude" placeholder="Longitude" readonly>
                                                    </div>
                                                    <div class="col-lg-6 mb-3">
                                                        <label for="inputThumbnail"
                                                            class="form-label text-black fw-bold">Thumbnail
                                                            Images</label>
                                                        <input type="file" class="form-control" name="thumbnails[]"
                                                            multiple accept="image/*">
                                                    </div>

                                                    <div class="col-lg-6 mb-3">
                                                        <label class="form-label text-black fw-bold">Additional
                                                            Images</label>
                                                        <div id="thumbnail-wrapper">
                                                            <!-- Additional file input fields will be dynamically added here -->
                                                        </div>
                                                        <button type="button" class="btn btn-secondary mt-2"
                                                            onclick="addFileInput()">Add More Images</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

</main>

<script>
    function addFileInput() {
        var inputWrapper = document.getElementById('thumbnail-wrapper');
        var newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'thumbnails[]';
        newInput.accept = 'image/*';
        newInput.classList.add('form-control', 'mt-2');
        inputWrapper.appendChild(newInput);
    }
</script>