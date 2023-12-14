<?php
include './authorization.php';
include "config.php";

if(isset($_POST['reports'])){
    $fdate = $_POST['fromdate'];
    $tdate = $_POST['todate'];
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
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    $fdate = $_POST['fromdate'];
                    $tdate = $_POST['todate'];

                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ret = mysqli_query($con, "select DISTINCT user.fullname,invoice.billing_number,invoice.billing_date from user inner join invoice on (user.id = invoice.user_id) where date(invoice.billing_date) BETWEEN '$fdate' and '$tdate'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $cnt; ?>
                                    </th>
                                    <td>
                                        <?php echo $row['billing_number']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['fullname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['billing_date']; ?>
                                    </td>
                                    <td>
                                        <a href="view-invoice.php?invoiceid=<?php echo $row['billing_number']; ?>"
                                            class="btn btn-primary">View</a>

                                    </td>
                                </tr>
                                <?php $cnt = $cnt + 1;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>