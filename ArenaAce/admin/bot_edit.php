<?php
include './authorization.php';
if (isset($_POST['submit'])) {
    require('config.php');
    $id = $_POST['id'];
    $query = $_POST['query'];
    $reply = $_POST['reply'];
    $sql = "UPDATE bot SET queries='{$query}', replies='{$reply}' WHERE id = '{$id}'";
    if (mysqli_query($con, $sql) or die("query failed")) {
        header("Location: bot.php");
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
                <h1>ChatBot</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Chatbot</a></li>
                        <li class="breadcrumb-item active">Edit Chatbot</li>
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
            <?php
                include 'config.php';
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM bot WHERE id = {$id}";
                    $result = mysqli_query($con,$sql) or die("query failed");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
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
                                                        <input type="hidden" class="form-control" name="id"
                                                            value="<?php echo $row['id']; ?>"
                                                            placeholder="Enter Bot ID">
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputName"
                                                                class="form-label text-black fw-bold">Queries</label>
                                                            <input type="text" class="form-control" name="query"
                                                                placeholder="Enter User Queires"
                                                                value="<?php echo $row['queries']; ?>">
                                                        </div>
                                                        <div class=" col-lg-6 mb-3">
                                                            <label for="inputAddress"
                                                                class="form-label text-black fw-bold">Replies</label>
                                                            <input type="text" class="form-control" name="reply"
                                                                placeholder="Enter Bot Reply"
                                                                value="<?php echo $row['replies']; ?>" autocomplete="
                                                                off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-dark">
                                    <div class="card-header bg-dark text-white">
                                        <h6>Action</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="submit" name="submit" class="btn btn-primary mt-3"
                                                    id="addImageInput">
                                                    Update Chat
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } }?>
            </div>
        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!--  Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>