<?php

include './authorization.php';
require('config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Vendor CSS Files -->
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
                <h1>Reports</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="title-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sportAdd">
                    Add New Sport
                </button>
            </div> -->
        </div>

        <section class="section dashboard">
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header">Between Dates Reports: </h5>
                <div class="card-body">
                    <div class="form-body">
                        <form method="post" action="show_reports.php">

                            <div class="form-group"> <label for="exampleInputEmail1">From Date</label> <input
                                    type="date" class="form-control" name="fromdate" id="fromdate" value=""
                                    required='true'> </div>
                            <div class="form-group"> <label for="exampleInputPassword1">To Date</label><input
                                    type="date" class="form-control" name="todate" id="todate" value="" required='true'>
                            </div>
                            <button type="submit" name="reports" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </section>

    </main><!-- End #main -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
</body>

</html>