<?php
require('config.php');

if (isset($_POST['keyword']) && isset($_POST['id']) && isset($_POST['sport'])) {
    $keyword = $_POST['keyword'];
    $id = $_POST['id'];
    $sport = $_POST['sport'];

    // Perform a database query based on the search criteria
    $sql = "SELECT arena.a_id as id, arena.name as arena, arena.thumbnail as image, arena.address arena_address, sport.name as sport
            FROM arena
            INNER JOIN assign_sport ON (arena.a_id = assign_sport.arena_id)
            INNER JOIN sport ON (sport.s_id = assign_sport.sport_id)
            WHERE sport.name = '$sport' AND arena.name LIKE '%$keyword%'";

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
                <a href="venue.php?arena_id=<?= $arena_id ?>">
                    <div class="arena-box">
                        <div class="thumbnail">
                            <img src="<?php echo 'admin/assets/upload/' . $image; ?>" class="img-fluid rounded-start" height="100px"
                                width="100px" alt="">
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
        echo "<h2 class='text-center text-white'>No matching results found</h2>";
    }
} else {
    echo "Missing required parameters.";
}
?>