<?php
include './authorization.php';
require('config.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    // file upload code start
    $filename = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    move_uploaded_file($tempname, 'assets/upload/' . $filename);
    // file upload code end
    $sql = "INSERT INTO `sport`(`name`,`image`) VALUES('{$name}','{$filename}')";
    if (mysqli_query($con, $sql) or die("Query failed")) {
        header("Location: sport.php");
    }
}
if(isset($_GET['delete_id'])){
    $sid = $_GET['delete_id'];
    mysqli_query($con, "delete from sport where s_id = '$sid'");
    echo "<script>alert('Data Deleted');</script>";
    echo "<script>window.location.href='sport.php'</script>";
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
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Sports</li>
                    </ol>
                </nav>
            </div>
            <div class="title-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sportAdd">
                    Add New Sport
                </button>
            </div>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row mt-3">
                                <div class="col">
                                    <?php
                                    include "config.php";
                                    $sql = "SELECT * FROM sport";
                                    $result = mysqli_query($con, $sql) or die("Query failed");
                                    if (mysqli_num_rows($result) > 0) {
                                        ?>
                                        <div class="table-responsive">
                                            <table class="table" id="myTable">
                                                <thead class="bg-dark text-white">
                                                    <tr>
                                                        <th scope="col">Sport Title</th>
                                                        <th scope="col">Sport Image</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $row['name'] ?>
                                                            </td>
                                                            <td>
                                                                <img src="<?php echo 'assets/upload/' . $row['image']; ?>"
                                                                    class="img-fluid rounded-start" height="100px" width="100px"
                                                                    alt="">
                                                            </td>
                                                            <td>
                                                            <button type="button" class="btn btn-primary editSport" id="<?=$row['s_id']?>" data-bs-toggle="modal" data-bs-target="#sportUpdate"> <i class="fa-solid fa-pen-to-square"></i></button>

                                                                <a class="btn btn-danger"
                                                                    href="sport.php?delete_id=<?php echo $row['s_id']; ?>"
                                                                    class="btn btn-danger"
                                                                    onClick="return confirm('Are you sure you want to delete?')"><i class="fa-solid fa-trash"></i></a>
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
                <!-- Modal -->
                <div class="modal fade" id="sportAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="sportAddLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="sportAddLabel">Add Sport</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12vmb-3">
                                            <label for="inputName" class="form-label">Sport Title</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="inputImage" class="form-label">Sport Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="inputDescription" class="form-label">Description</label>
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- update sport -->
                <div class="modal fade" id="sportUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="sportAddLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="sportAddLabel">Add Sport</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12vmb-3">
                                            <label for="inputName" class="form-label">Sport Title</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="inputImage" class="form-label">Sport Image</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <label for="inputDescription" class="form-label">Description</label>
                                            <textarea class="form-control" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary"
                                        data-bs-dismiss="modal">cancel</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
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

        $(document).ready(function(){
            $(document).on('click', ".editSport", function(e) {
                e.preventDefault();
                let id = $(this).attr('id');
                // alert(id);
                $.ajax({
                    url: "./sport_update.php",
                    method: "GET",
                    dataType: "json",
                    data: {sport_id: id},

                    success: function(data) {
                        console.log(data);
                    }

                });

            });

        });
    </script>

</body>

</html>