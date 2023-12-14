<?php
session_start();
session_regenerate_id(true);
?>

<?php
require('config.php');

$sport_id = $_GET['id'];
$sport = $_GET['sport'];

// echo $id,$sport;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arenas | Arena Ace</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            background-color: #1d1d1d;
        }
    </style>
</head>

<body>

    <!-- Navbar section starts -->

    <?php include "navbar.php"; ?>

    <!-- Navbar section ends -->

    <?php include "bot.php"; ?>


    <!-- arena-nav section starts -->

    <section id="arena-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="arena-top d-flex justify-content-between align-items-center">
                        <div class="arena-left">
                            <h2>Discover and book top
                                <?= $sport; ?> arena
                            </h2>
                        </div>
                        <div class="arena-right">
                            <div class="input-group rounded">
                                <input type="search" name="a_search" id="a_search" class="form-control rounded"
                                    placeholder="Search by arena name" aria-label="Search"
                                    aria-describedby="search-addon" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- arena-nav section ends -->

    <!-- arena section starts -->

    <section id="arena">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="title text-center">
                        <h2 class="heading">
                            <?= $sport; ?> arena
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                include "config.php";
                $sql = "select arena.a_id as id,arena.name as arena,arena.thumbnail as image,arena.address arena_address,sport.name as sport from arena inner join assign_sport on (arena.a_id = assign_sport.arena_id) inner join sport on (sport.s_id = assign_sport.sport_id) where sport.name = '$sport'";
                $result = mysqli_query($con, $sql) or die("Query failed");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $arena_id = $row['id'];
                        $arena = $row['arena'];
                        $arena_address = $row['arena_address'];
                        $sport = $row['sport'];
                        $image = $row['image'];
                        ?>
                        <div class="col-lg-4">
                            <a href="venue.php?arena_id=<?= $arena_id ?>&&sport_id=<?=$sport_id?>">
                                <div class="arena-box">
                                    <div class="thumbnail">
                                        <img src="<?php echo 'admin/assets/upload/' . $image; ?>"
                                            class="img-fluid rounded-start" height="100px" width="100px" alt="">
                                        <div class="thumb-text">
                                            <h6>Bookable</h6>
                                        </div>
                                    </div>
                                    <div class="arena-body">
                                        <div class="arena-name">
                                            <h6>
                                                <?php echo $arena ?>
                                            </h6>
                                        </div>
                                        <p class="address">
                                            <?php echo $arena_address ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                } else {
                    echo "<h2 class='text-center text-white'>Sorry!! no arena available for selected sport</h2>";
                }
                ?>
            </div>
    </section>

    <!-- arena section ends -->




    <!-- Footer section starts -->

    <?php include "footer.php"; ?>

    <!-- Footer section ends -->





    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script>
        window.addEventListener("scroll", function () {
            var nav = document.querySelector("nav");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
    <script>
        $(document).ready(function () {
            $("#a_search").on("input", function () {
                var keyword = $(this).val();
                var id = <?= $id ?>;
                var sport = <?= json_encode($sport) ?>;
                
                // Send an AJAX request to the search-arena.php file with keyword, id, and sport values
                $.ajax({
                    type: "POST",
                    url: "search-arena.php",
                    data: { keyword: keyword, id: id, sport: sport }, // Pass id and sport here
                    success: function (response) {
                        $("#arena .row").empty();
                        $("#arena .row").html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>