<?php
session_start();

require('config.php');

if (isset($_POST['register'])) {
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    // Validate Full Name
    if (empty($fullname)) {
        echo "<script>alert('Please enter your full name.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Validate Email
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Validate Address
    if (empty($address)) {
        echo "<script>alert('Please enter your address.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Validate Phone
    if (empty($phone) || !preg_match('/^\d{10}$/', $phone)) {
        echo "<script>alert('Please enter a valid phone number.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Validate Password
    if (empty($password)) {
        echo "<script>alert('Please enter a password.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Check password strength
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
        echo "<script>alert('Password should be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Validate Confirm Password
    if (empty($cpassword) || $password !== $cpassword) {
        echo "<script>alert('Passwords do not match.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Check if the email already exists
    $emailquery = "SELECT * FROM user WHERE email = '$email'";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);

    if ($emailcount > 0) {
        echo "<script>alert('Email already exists.'); window.location.href = 'userRegister.php';</script>";
        exit();
    }

    // Insert user data into the database
    $filename = mysqli_real_escape_string($con, $_FILES['image']['name']);
    $tempname = mysqli_real_escape_string($con, $_FILES['image']['tmp_name']);
    move_uploaded_file($tempname, 'assets/upload/' . $filename);

    $insertquery = "INSERT INTO `user`(`fullname`, `u_image`,`email`,`address`, `phone`, `password`, `cpassword`) VALUES ('$fullname','$filename','$email','$address','$phone','$password','$cpassword')";

    $iquery = mysqli_query($con, $insertquery);

    if ($iquery) {
        echo "<script>alert('Registered Successfully'); window.location.href = 'userLogin.php';</script>";
        exit();
    } else {
        echo "<script>alert('Registration Failed'); window.location.href = 'userRegister.php';</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login || ArenaAce</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/all.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #reg {
            position: relative;
            height: 130vh;
        }

        #reg .background-container {
            background: linear-gradient(#0007, #0008), url(assets/images/loginBg2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
            position: absolute;
            filter: blur(10px);
            z-index: -1;
            width: 100%;
        }

        #reg .reg-images {
            width: 100%;
            height: 100%;
            padding: 10px 5px;
        }

        #reg .reg-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            overflow: hidden;
            border-top-left-radius: 40px;
            border-bottom-left-radius: 40px;
        }

        #reg .reg-container {
            background-color: #fff;
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            margin: 0 auto;
            border-radius: 40px;
        }

        #reg .reg-right {
            background-color: #fff;
            color: #000;
            text-align: center;
            margin-left: -50px;
            border-top-left-radius: 60px;
            border-bottom-left-radius: 60px;
        }

        #reg .reg-right .form-content {
            padding: 60px 0;
            padding-left: 20px;
            overflow: hidden;
        }

        #reg .reg-right .form-top h2 {
            font-size: 1.6rem;
            font-weight: 700;
        }

        #reg .reg-right .form-top h2 span {
            color: #A70500;
        }

        #reg .reg-right .form-top .google {
            outline: none;
            background-color: #fff;
            border: 2px solid #555555;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 50px;
            border-radius: 5px;
            margin: 12px 0;
        }

        #reg .reg-right .form-top p {
            font-size: 0.9rem;
            font-weight: 600;
            position: relative;
        }

        #reg .reg-right .form-top p::before {
            content: '';
            position: absolute;
            height: 3px;
            width: 60px;
            background-color: #000;
            left: 135px;
            top: 11px;
        }

        #reg .reg-right .form-top p::after {
            content: '';
            position: absolute;
            height: 3px;
            width: 60px;
            background-color: #000;
            right: 135px;
            top: 11px;
        }

        #reg .reg-right .form-mid input {
            height: 40px;
        }

        #reg .reg-right .form-mid .form-control:focus {
            background-color: #FFF;
            outline: none;
            box-shadow: none;
        }

        #reg .reg-right .form-mid button {
            background-color: #A70500;
            color: #FFF;
            padding: 10px 0;
            border-radius: 20px;
            font-weight: 600;
        }

        #reg .reg-right .form-bottom {
            margin-top: 10px;
        }

        #reg .reg-right .form-bottom p {
            font-size: 0.9rem;
            font-weight: 500;
        }

        #reg .reg-right .form-bottom span a {
            color: #A70500;
        }

        #reg .reg-right .form-bottom ul li {
            display: inline-block;
            margin-right: 15px;
        }

        #reg .reg-right .form-bottom ul li i {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <section id="reg">
        <div class="background-container"></div>
        <div class="container">
            <div class="reg-container">
                <div class="row">
                    <div class="col-lg-6 reg-left">
                        <div class="reg-images">
                            <img src="assets/images/loginBg2.jpg" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 reg-right">
                        <div class="form-content">
                            <div class="form-top">
                                <h2>Log in to <span>ArenaAce</span></h2>
                            </div>
                            <div class="form-mid mt-5">
                                <form class="row g-3 needs-validation" novalidate
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <input type="text" class="form-control" name="fullname" placeholder="Full Name">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <input type="text" class="form-control" name="address" placeholder="Address">
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email Address" autocomplete="off">
                                        </div>
                                        <div class="col-lg-12 input-group mb-3">
                                            <label class="input-group-text" for="inputGroupFile01">Profile</label>
                                            <input type="file" class="form-control" name="image" id="inputGroupFile01">
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Password" autocomplete="off">
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="form-control" name="register">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="form-bottom">
                                <p>Already have an account? <span><a href="userLogin.php">Login</a></span></p>
                                <div class="reg-social">
                                    <ul>
                                        <li><a href="#">
                                                <i class="fa-brands fa-facebook"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-instagram"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-github"></i>
                                            </a></li>
                                        <li><a href="#">
                                                <i class="fa-brands fa-linkedin"></i>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>