<?php
session_start();
session_regenerate_id(true);

// $cart_number = rand(1000, 9999);
// $_SESSION['CN'] = $cart_number;

// $un = $_SESSION['CN'];
// echo $un;
if (!isset($_SESSION['CN'])) {
    $uniqueNumber = sprintf('%04d', rand(0, 9999));

    $_SESSION['CN'] = $uniqueNumber;
}

// echo $_SESSION['CN'];
$CN = $_SESSION['CN'];
echo $CN;

if (!isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'client') {
    header('location:userLogin.php');
    die();
}
// echo $_SESSION['username'];
// echo $_SESSION['user_id'];
// echo $_SESSION['USER'];
if (isset($_SESSION['USER'])) {
    $info = $_SESSION['USER'];
    $user_id = $info['id'];
    // echo $user_id;
}
include "config.php";

if (isset($_GET['arena_id']) && isset($_GET['sid'])) {
    // $sport = $_GET['sport'];
    $arena_id = $_GET['arena_id'];
    $sport_id = $_GET['sid'];
    //echo $arena_id,$sport_id;
}


if (isset($_POST['addToCart'])) {
    // $user_id ;
    $cart_number = $CN;
    $sport = $_POST['sport'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $court = $_POST['court'];

    $query = "INSERT INTO `court_cart`( cart_number,`user_id`, `court_id`, sport_id,`date`, `time`) VALUES ($cart_number,$user_id,'$court','$sport','$date','$time')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Query was successful
        $successMessage = "Service added to Cart!";
    } else {
        // Query failed
        $errorMessage = "Error: " . mysqli_error($con);
    }
}
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$filename = basename(parse_url($url, PHP_URL_PATH));
// echo $filename;
if ($filename == 'checkout.php') {
    require "book_process.php";
}

$sqlArena = "SELECT * FROM arena where a_id = '$arena_id'";
$resultArena = mysqli_query($con, $sqlArena) or die("Query failed");
if (mysqli_num_rows($resultArena) > 0)
    while ($row = mysqli_fetch_assoc($resultArena)) {
        // print_r($result); exit;
        $id = $row['a_id'];
        $name = $row['name'];
        $address = $row['address'];
        $phone = $row['phone'];
        $image = $row['thumbnail'];
        $description = $row['description'];
        $thumbnail = $row['thumbnail'];
        $latitude = $row['latitude'];
        $longitude = $row['longitude'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #1B1B1B;
            color: #ffffff;
        }

        #timeslot {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
    </style>

</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <!-- checkout section starts -->

    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="checkout-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="checkout-card">
                                    <div class="container mt-5">
                                        <?php if (isset($successMessage)) { ?>
                                            <div class="alert alert-success">
                                                <?php echo $successMessage; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if (isset($errorMessage)) { ?>
                                            <div class="alert alert-danger">
                                                <?php echo $errorMessage; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="checkout-card-top">
                                        <h1 class="ckName">
                                            <?= $name ?>
                                        </h1>
                                        <h5 class="ckAddress">
                                            <?= $address ?>
                                        </h5>
                                    </div>
                                    <div class="checkout-detail">
                                        <form action="" method="POST">
                                            <div class="row mb-4">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Sports</label>
                                                <div class="col-sm-8">
                                                    <select name="sport" id="inputSport" class="form-select">
                                                        <option selected>Choose...</option>
                                                        <?php
                                                        //    $query = "SELECT sport.name as sport_name,sport.s_id as sport_id,arena.name from sport inner join assign_sport on (assign_sport.sport_id = sport.s_id) inner join arena on (arena.a_id = assign_sport.arena_id) where arena.a_id = $arena_id and sport.s_id =$sport_id";
                                                        
                                                        $query = "SELECT sport.name as sport_name,sport.s_id as sport_id,arena.name from sport inner join assign_sport on (assign_sport.sport_id = sport.s_id) inner join arena on (arena.a_id = assign_sport.arena_id) where arena.a_id = $arena_id";
                                                        $results = mysqli_query($con, $query);

                                                        foreach ($results as $s):

                                                            ?>
                                                            <option value="<?= $s['sport_id'] ?>">
                                                                <?= $s['sport_name']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <input type="hidden" id="arenaID" name="a" value="<?= $arena_id ?>">
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <label for="inputEmail3" id=""
                                                    class="col-sm-4 col-form-label">Date</label>
                                                <div class="col-sm-8">
                                                    <input name="date" type="date" class="form-control" id="date_s">
                                                </div>
                                            </div>
                                            <!-- <div class="row mb-4">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Time</label>
                                                <div class="col-sm-8">
                                                    <input name="time" type="time" class="form-control" id="inputZip">
                                                </div>
                                            </div> -->
                                            <div class="row mb-4">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label">Courts</label>
                                                <div class="col-sm-8">
                                                    <select name="court" id="inputCourt" class="form-select">
                                                        <option selected>--Select Court--</option>
                                                        <?php

                                                        $query = "SELECT courts.court_id, courts.name as court_name,courts.price,sport.name as sport_name,arena.name as arena_name from courts inner join assign_court on (courts.court_id = assign_court.court_id) inner join sport on (sport.s_id = assign_court.sport_id) inner join arena on (arena.a_id = assign_court.arena_id) where arena.a_id = $arena_id and sport.s_id = $sport_id";
                                                        $courts = mysqli_query($con, $query);


                                                        foreach ($courts as $court):
                                                            ?>
                                                            <option value="<?= $court['court_id'] ?>">
                                                                <?= $court['court_name'] . ' @RS.' . $court['price']; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div id="timeslot">
                                                    <!-- <div class="form-check">
                                                    <input type="radio" name="time" id="time1" value="Time_Slot_1"
                                                        disabled>
                                                    <label for="time1"
                                                        class="btn btn-outline-primary status-class">12:00 PM</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="time" id="time2" value="Time_Slot_2">
                                                    <label for="time2" class="btn btn-outline-primary">01:00 PM</label>
                                                </div> -->
                                                </div>
                                            </div>
                                            <div class="row  mt-5 mb-4">
                                                <div class="d-grid gap-2">
                                                    <button class="btn btn-book" name="addToCart" type="submit"><i
                                                            class="fa-solid fa-cart-shopping"></i><span>Add to
                                                            Cart</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- cart section -->
                            <div class="col-lg-4">
                                <div class="checkout-card">
                                    <div class="cart-top d-flex justify-content-between">
                                        <h5 class="title">Cart</h5>
                                        <p><i class="fa-solid fa-trash"></i></p>
                                    </div>
                                    <div class="cart-top-border"></div>
                                    <div class="cart-body">
                                        <ul class="list-group list-group-flush">
                                            <?php
                                            $query = "SELECT courts.name as c_n,courts.price as c_p,courts.discount,user.fullname,court_cart.date as date,court_cart.time as time, court_cart.id from courts inner join court_cart on (courts.court_id = court_cart.court_id) inner join user on (user.id = court_cart.user_id) where user.id = $user_id and court_cart.status =1";
                                            $carts = mysqli_query($con, $query);
                                            //    print_r($carts);exit;
                                            $nums = mysqli_num_rows($carts);
                                            if ($nums > 0) {
                                                foreach ($carts as $cart):


                                                    ?>
                                                    <li class="list-group-item mt-2">
                                                        <div
                                                            class="cart-arena d-flex justify-content-between align-items-center mb-2">
                                                            <h5><i class="fa-solid fa-play"></i> <span>
                                                                    <?= $cart['c_n'] ?>
                                                                </span></h5>
                                                            <a href="cart_delete.php?id=<?= $cart['id'] ?>"><i
                                                                    class="fa-solid fa-xmark"></i></a>
                                                        </div>
                                                        <div
                                                            class="cart-dateTime d-flex justify-content-between align-items-center mb-2">
                                                            <h5><i class="fa-solid fa-calendar"></i> <span>
                                                                    <?= $cart['date'] ?>
                                                                </span>
                                                            </h5>
                                                            <h5><i class="fa-solid fa-clock"></i> <span>
                                                                    <?= $cart['time'] ?>
                                                                </span></h5>
                                                        </div>
                                                        <div class="cart-Price">
                                                            <h5><i class="fa-solid fa-money-bill"></i> <span>
                                                                    <?= $cart['c_p'] ?>
                                                                </span>
                                                            </h5>
                                                        </div>
                                                    </li>
                                                <?php endforeach;
                                            } ?>

                                        </ul>
                                        <form action="" method="post">
                                            <div class="d-grid gap-2 mt-3">
                                                <input type="hidden" name="cart_no" value="<?= $CN ?>">
                                                <input type="hidden" name="arena_id" value="<?= $arena_id ?>">
                                                <input type="hidden" name="user_id" value="<?= $user_id ?>">
                                                <button class="btn btn-book" type="submit" name="book_appointment"><i
                                                        class="fa-solid fa-cart-shopping"></i><span>Make your
                                                        Booking</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- checkout section ends -->



    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#inputSport").change(function () {
                var sid = $(this).val();
                var aid = $("#arenaID").val();
                // console.log(aid);
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        sid: sid,
                        aid: aid
                    },
                    success: function (data) {
                        $("#inputCourt").html(data);
                        console.log(data);
                    }
                });
            });



            $("#date_s").on('input', function () {
                console.log("ma aaye")
                var dat = $(this).val();
                var cid = $("#inputCourt").val();
                // console.log(cid,dat);
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    dataType: "json",

                    data: {
                        date: dat,
                        cid: cid
                    },
                    success: function (response) {

                        //    $("#timeslot").html(response);
                        // //    $("#timeslot").text(response);
                        //      console.log(response);
                        //      console.log("Success");
                        if (response.length > 0) {
                            console.log(response);
                            $("#timeslot").html(response.join(''));
                            console.log("Success");
                        } else {
                            console.log("Empty response");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error:", error);
                    }
                });
            });
        });
    </script>

</body>

</html>