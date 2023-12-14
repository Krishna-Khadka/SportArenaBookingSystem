<?php 
include './authorization.php';
require('config.php');
    if(isset($_GET['BID'] )&& $_GET['invoice']){
        $book_number = $_GET['BID'];
        $invoiceID = $_GET['invoice'];
    }

    if(isset($_GET['CN'])){
        $cart_number = $_GET['CN'];
    }

    echo $cart_number;
    $queryCart = " select court_id as cid,date, time from court_cart where cart_number = $cart_number ";
    $cartResults = mysqli_query($con, $queryCart);

    while ($row = mysqli_fetch_assoc($cartResults)){
        $cid = $row['cid'];
        $date = $row['date'];
        $time = $row['time'];

        $rowData = array(
            'cid' => $cid,
            'date' => $date,
            'time' => $time
        );

        $cartData[] = $rowData;
    }


    // print_r($cartData);


    if(isset($_POST['pay'])){
        
        $payment_method = $_POST['payment_method'];
        $payment_status = $_POST['payment_status'];

        $query = "update payment set payment_method='$payment_method', payment_status='$payment_status' where book_number=$book_number";
        $payStatus = mysqli_query($con, $query);

        $statusUpdate = "update arena_booking set book_status = 'checkout' where book_number = '$book_number' ";
        $statusResult = mysqli_query($con, $statusUpdate);

        if($payment_status){
            foreach($cartData as $data){
                $cid = $data['cid'];
                $date = $data['date'];
                $time = $data['time'];
                $updateSlot = "update time_slots set isBooked = 0 where date = '$date' and time = '$time' and court_id = '$cid'";
                $slotResult = mysqli_query($con, $updateSlot);
            }
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
    <div class="row">
        <div class="col-4">
            <form action=""  method="post">
                <h2>Pay and Checkout</h2>
                <label for="">Payment Mode</label>
                <select class="form-control" name="payment_method" id="">
                    <option>Choose</option>
                    <option value="cash">Cash</option>
                    <option value="online">Online</option>
                </select>
                <label for="">Payment Status</label>
                <select class="form-control" name="payment_status" id="">
                    <option>Choose</option>
                    <option value="paid">Paid</option>
                    <!-- <option value="due">Due</option> -->
                </select>
                <button type="submit"  class="btn btn-primary mt-3" name="pay">Pay and Checkout</button>
             </form>
        </div>
    </div>
 
</body>
</html>