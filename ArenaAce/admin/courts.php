<?php
include './authorization.php';
include 'config.php';
if(isset($_GET['delete_id'])){
    $sid = $_GET['delete_id'];
    mysqli_query($con, "delete from courts where court_id = '$sid'");
    echo "<script>alert('Data Deleted');</script>";
    echo "<script>window.location.href='courts.php'</script>";
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
                <li class="breadcrumb-item active">Arena</li>
            </ol>
            </nav>
        </div>
        <div class="title-right">
            <a class="btn btn-primary" href="add_court.php">
                Add New Court
            </a>
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
                        $sql = "SELECT * FROM courts";
                        $result = mysqli_query($con,$sql) or die("Query failed");
                        if(mysqli_num_rows($result) > 0){
                        ?>
                    <div class="table-responsive">
                        <table class="table" id= "myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            while($row = mysqli_fetch_assoc($result)){
                                $description = $row['description'];
                                $truncated_description = strlen($description) > 50 ? substr($description, 0, 50) . '...' : $description;
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $row['name']?>
                                    </td>
                                    <td>
                                        <?php echo $row['price']?>
                                    </td>
                                    <td>
                                        <?php echo $row['created_at']?>
                                    </td>
                                    <td>
                                        
                                        <a href="update_court.php?id=<?php echo $row['court_id'] ?>">
                                            <button class="btn btn-success"><i class="fa-solid fa-pen"></i></button>
                                        </a>
                                        <a href="courts.php?delete_id=<?php echo $row['court_id'] ?>" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </a>
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
      </div>
    </section>

  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script src="assets/js/sweetalert.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
     $('#myTable').DataTable({
           
           "ordering": false,

           "lengthMenu": [
               [3, 10, 25, 50, 100, -1],
               [3, 10, 25, 50, 100, 'All']
           ],
           language: {
               search: "_INPUT_",
               searchPlaceholder: "Search..."
           }
       });

    $(document).ready(function () {
        $('.delete_arena_btn').click(function (e) { 
            e.preventDefault();
            var id = $(this).val();

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover arena data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: "arena.php", // Update with your PHP file
                        data: {
                            'arena_id': id,
                            'delete_arena_btn': true
                        },
                    });
                }
            });
        });
    });
  </script>

</body>

</html>
