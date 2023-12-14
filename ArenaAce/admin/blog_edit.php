<?php
require ('config.php');
include './authorization.php';

if(isset($_POST['update'])){
    $b_id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
     $filename = $_FILES['thumbnail']['name'];
     $tempname = $_FILES['thumbnail']['tmp_name'];
     move_uploaded_file($tempname,'assets/upload/'.$filename);
     // file upload code ends

     if($_FILES['image']['name'] != ""){
        $filename = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempname,'assets/upload/'.$filename);
        }
        else{
            $filename=$_POST['oldimage'];
        }

    $sql = "UPDATE blog SET title='{$title}', author='{$author}', description='{$description}', image='{$filename}' WHERE b_id='{$b_id}'";

    if(mysqli_query($con,$sql) or die("query failed")){
        header("Location: blog.php");
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
                <h1>Sports</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Blogs</a></li>
                        <li class="breadcrumb-item active">Add Blog</li>
                    </ol>
                </nav>
            </div>
            <!-- <div class="title-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sportAdd">
                    Add New Blog
                </button>
            </div> -->
        </div>

        <section class="section dashboard">
            <div class="row">
                <?php
                    $b_id = $_GET['id'];
                    $sql = "SELECT * FROM blog WHERE b_id = {$b_id}";
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
                                        <h6>Add Blog</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="modal-body">
                                                    <div class="row mt-3">
                                                    <input type="hidden" class="form-control" name="b_id" value="<?php echo $row['b_id']; ?>"
                                                                placeholder="Enter Blog ID">
                                                    <!-- <div class="col-lg-6 mb-3">
                                                            <label for="inputTitle"
                                                                class="form-label text-black fw-bold">Blog ID</label>
                                                            
                                                    </div> -->
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputTitle"
                                                                class="form-label text-black fw-bold">Blog Title</label>
                                                            <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>"
                                                                placeholder="Enter Blog Title">
                                                        </div>
                                                        
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="inputAuthor"
                                                                class="form-label text-black fw-bold">Blog Author</label>
                                                            <input type="text" class="form-control" name="author" value="<?php echo $row['author']; ?>"
                                                                placeholder="Enter Author Name">
                                                        </div>
                                                        <div class="col-lg-12 mb-3">
                                                            <label for="description"
                                                                class="form-label text-black fw-bold">Description</label>
                                                            <textarea class="form-control" name="description"
                                                                id="description" placeholder="Enter Description"
                                                                cols="30" rows="4" maxlength="250"><?php echo $row['description']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-dark">
                                            <div class="card-header bg-dark text-white">
                                                <h6>Blog Thumbnail</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div id="imagePreview"></div>
                                                    <label for="inputThumbnail" class="form-label text-black fw-bold">Blog Thumbnail</label>
                                                    <img src="<?php echo 'assets/upload/'.$row['image']; ?>" alt="" width=100px;>
                                                    <input type="hidden" name="oldimage" value="<?php echo $row['image']; ?>">
                                                    <input type="file" class="form-control" id="inputThumbnail" name="thumbnail" placeholder="Enter Blog thumbnail" onchange="previewImage(event)">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" name="update"
                                        class="btn btn-primary">Update Blog</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>

    </main><!-- End #main -->



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById("imagePreview");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview Image" style="max-width: 100%; height: auto;">';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

    <!--  Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>