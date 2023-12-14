<?php
    require("config.php");
    include './authorization.php';
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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Arena Ace</span>
                </a>
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                    class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control">
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">Login</button>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

<?php

  function input_filter($data){
      $data=trim($data);
      $data=stripslashes($data);
      $data=htmlspecialchars($data);
      return $data;
  }

  if(isset($_POST['login'])){
      // filtering users input
      $username=input_filter($_POST['username']);
      $password=input_filter($_POST['password']);

      // prevent sql injection
      $username=mysqli_real_escape_string($con,$username);
      $password=mysqli_real_escape_string($con,$password);

      // query template
      $query = "SELECT * FROM `admin_login` WHERE `adm_name`=? AND `adm_pass`=?";

      // prepared statement
      if($stmt=mysqli_prepare($con,$query)){
          // echo"prepared";
          mysqli_stmt_bind_param($stmt,"ss",$username,$password); //binding values to template
          mysqli_stmt_execute($stmt); //execute prepared statement
          mysqli_stmt_store_result($stmt); //transferring the result of execution in $stmt
          if(mysqli_stmt_num_rows($stmt)==1){
              session_start();
              $_SESSION['AdminLoginId']=$username;
              $_SESSION['user_role']="admin";
              header("location: index.php");
          }
          else{
              echo"<script>alert('Invalid username or password');</script>";
          }
          mysqli_stmt_close($stmt);
      }
      else{
          echo"<script>alert('Invalid username or password');</script>";
      }
  }

?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!--  Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>