<?php
include './authorization.php';
require('config.php');
$user_id = $_GET['user_id'];
$book_number = $_GET['book_number'];
// echo $book_number;
$sql = "SELECT court_cart.id,court_cart.cart_number as CN,courts.name AS court_name,courts.court_id, courts.price, courts.discount, court_cart.date, court_cart.time
FROM court_cart
INNER JOIN courts ON court_cart.court_id = courts.court_id where court_cart.user_id = $user_id";
$result = mysqli_query($con, $sql) or die("Query failed");
// while ($row = mysqli_fetch_assoc($result)) {
//     $court_id = $row['court_id'];
//     echo $court_id;
// }

// print_r($_SESSION['court_ids']);
$cids = $_SESSION['court_ids'];

if(isset($_POST['book_save'])){
    $book_status = $_POST['book_status'];
    $remarks = $_POST['remarks'];

    // echo $book_status;exit;
    $timestamp = time();
    // Generate a random 3-digit number
    $randomNumber = mt_rand(100, 999);
    // Combine timestamp and random number and take the last 6 digits
    $invoiceNumber = substr($timestamp . $randomNumber, -6);

    // echo $invoiceNumber; exit;

    foreach($cids as $cid){
        $query = "INSERT INTO `invoice`(`user_id`, `court_id`, `billing_number`) VALUES ('$user_id','$cid','$invoiceNumber')";
        // echo $query; exit;
        $invoiceResult = mysqli_query($con, $query);
    }

    $sqlQuery = "update arena_booking set book_status = '$book_status',remarks='$remarks' where book_number = $book_number ";
    $bookStatus = mysqli_query($con, $sqlQuery);

    if($invoiceNumber){
        echo '<script>
        alert("your invoice number is : '.$invoiceNumber.'")
    </script> ';
    }


    // echo $invoiceNumber;exit;

}

 if(isset($_POST['pay_now'])){
    $cart_number = $_POST['cart_number'];
    // echo $cart_number; exit;
    $bill_no = $_POST['bill_no'];
    $total = $_POST['total'];
    $user_id = $_POST['user_id'];
    $book_number = $_POST['book_number'];

    $insertpayment = "INSERT INTO `payment`(`user_id`, `invoice_id`, `book_number`, `payable_amount`) VALUES ('$user_id','$bill_no','$book_number','$total')";
    $bookStatus = mysqli_query($con, $insertpayment);

    if($bookStatus){
        header("Location: payment.php?BID=$book_number&&invoice=$bill_no&&CN=$cart_number");
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

            <?php
            $sql_verify = "select * from arena_booking where book_number = '$book_number'";
            $res = mysqli_query($con,$sql_verify);
            $row = mysqli_fetch_assoc($res);
            if($row['book_status'] != 'select'){?>

<div class="col-lg-12">
                    <!-- Your existing table code ... -->

                    <!-- Add the form here -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="book_status">Book Status</label>
                            <select class="form-control" id="book_status" name="book_status">
                                <option disabled selected>Choose...</option>
                                <option value="select">Select Booking</option>
                                <!-- <option value="reject">Reject Booking</option> -->
                                <!-- <option value="pending">Pending</option> -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea type="text" class="form-control" id="remarks" name="remarks"></textarea>
                        </div>
                        <!-- <div class="form-group">
                            <label for="generate_invoice">Generate Invoice ID</label>
                            <select class="form-control" id="generate_invoice" name="generate_invoice"> -->
                            <!-- <option disabled selected value="-1">--Generate Invoice--</option> -->
                                <!-- <option value="generate_now">Generate Now</option>
                                <option value="not_generate_now">Not Generate Now</option>
                            </select> -->
                        <!-- </div> -->
                        <button type="submit" name="book_save"  class="btn btn-primary my-4">Save</button>
                    </form>
                </div>

          <?php  }

            
            ?>
                
            </div>
        </section>

        

        <section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <?php
           
            if (mysqli_num_rows($result) > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table" id="myTable">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col" style="width:14%" class="text-center">Court Name</th>
                                <!-- <th scope="col" style="width:14%" class="text-center">Cart Number</th> -->
                                <th scope="col" style="width:14%" class="text-center">Price</th>
                                <th scope="col" style="width:14%" class="text-center">Discount</th>
                                <th scope="col" style="width:14%" class="text-center">Date</th>
                                <th scope="col" style="width:14%" class="text-center">Time</th>
                                <th scope="col" style="width:30%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalPrice = 0;
                            // $courtIds();
                            $courtIds = [];
                            while ($row = mysqli_fetch_assoc($result)) {
                                $cart_num = $row['CN'];
                                $court_id = $row['court_id'];
                                $courtIds[] = $court_id;
                                $price = $row['price'];

                                $_SESSION['court_ids'] = $courtIds;

                                $totalPrice +=$price;
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo $row['court_name'] ?>
                                    </td>
                                    <!-- <td class="text-center">
                                        <?php //echo $row['CN'] ?>
                                    </td> -->
                                    <td class="text-center">
                                        <?php echo $row['price'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['discount'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['date'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['time'] ?>
                                    </td>
                                    <td class="text-center">
                                        <!-- <a class="btn btn-primary"
                                            href='view_booking_details.php?id=<?php echo $row["id"]; ?>'><i class="fa-solid fa-circle-info"></i></a> -->
                                        <a class="btn btn-danger"
                                            href='users_delete.php?id=<?php echo $row["id"]; ?>'><i
                                            class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php }
                             //  print_r($courtIds);
                            //   print_r($_SESSION['court_ids']);
                            ?>
                            
                        </tbody>
                    </table>

                    <div class="card">
                        <div class="card-header">
                        Payment
                        </div>
                        <div class="card-body">
                            <?php 
                               $sql = "select * from invoice where user_id=$user_id";
                               $results = mysqli_query($con, $sql);

                               if($results){
                               foreach($results as $res);
                               
                               $sql1 = "select payment_status from payment where invoice_id=$res[billing_number]";
                               $res_sql1 = mysqli_query($con, $sql1);
                               $row1 = mysqli_fetch_assoc($res_sql1);
                               
                               ?>
                               <form action="" method="post">
                                <input type="hidden" name="cart_number" value="<?=$cart_num;?>">
                                Invoice Number: #<?=$res['billing_number']; ?> <br>
                                <input type="hidden" name="bill_no" value="<?=$res['billing_number']?>">
                                Total Amount: <?=$totalPrice?> <br>
                                Payment Status : <?php if($row1 > 0) { echo $row1['payment_status']; }else { echo "Due"; } ?> <br><br>
                                <input type="hidden" name="total" value="<?=$totalPrice?>">
                                <input type="hidden" name="user_id" value="<?=$user_id?>">
                                <input type="hidden" name="book_number" value="<?=$book_number?>">

                                <?php if($row1 > 0 ){ if($row1['payment_status'] != 'paid'){?>
                                <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                                <?php }else{ echo ""; } }else { ?>
                                    <button type="submit" name="pay_now" class="btn btn-primary">Pay Now</button>
                               <?php  } ?>
                            </form>
                               
                               <?php

                             } else{
                                echo "no record found";
                             }
                            ?>
                            
                        </div>
                    </div>
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